<?php

namespace CAIF\SharedBundle\Controller;

// use Pagerfanta\Adapter\DoctrineORMAdapter;
// use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use CAIF\SharedBundle\Entity\Event;
use CAIF\SharedBundle\Entity\EnglishClass;
use CAIF\SharedBundle\Entity\InternationalClub;
use CAIF\SharedBundle\Entity\Rsvp;

class EventController extends Controller
{
    /**
     * @Route("/events/all/{page}", name="caif_shared_event_index", defaults={"page" = "1"}, requirements={"page" = "\d+"})
     */
    public function indexAction($page)
    {
        $em         = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('CAIFSharedBundle:Event');
        $events     = $repository->createQueryBuilder('e')
            ->where('e.endDate >= :today')
            ->setParameter('today', date('Y-m-d', strtotime('now')))
            ->orderBy('e.startDate', 'ASC')
            ->getQuery()
            ->getResult();

        // $adapter    = new DoctrineORMAdapter($queryBuilder, false);
        // $pagerfanta = new Pagerfanta($adapter);
        // $pagerfanta->setMaxPerPage(5);
        // $pagerfanta->setCurrentPage($page);

        return $this->render('CAIFSharedBundle:Event:index.html.twig', [
            'events' => $events,
        ]);
    }

    /**
     * @Route("/events/past/{page}", name="caif_shared_event_past", defaults={"page" = "1"}, requirements={"page" = "\d+"})
     */
    // public function pastAction($page)
    // {
    //     $em           = $this->getDoctrine()->getManager();
    //     $repository   = $em->getRepository('CAIFSharedBundle:Event');
    //     $queryBuilder = $repository->createQueryBuilder('e')
    //         ->where('e.endDate < :today')
    //         ->setParameter('today', date('Y-m-d', strtotime('now')))
    //         ->orderBy('e.startDate', 'ASC');

    //     $adapter    = new DoctrineORMAdapter($queryBuilder, false);
    //     $pagerfanta = new Pagerfanta($adapter);
    //     $pagerfanta->setMaxPerPage(5);
    //     $pagerfanta->setCurrentPage($page);

    //     return $this->render('CAIFSharedBundle:Event:pastEvents.html.twig', [
    //         'events' => $pagerfanta->getCurrentPageResults(),
    //         'pager'  => $pagerfanta,
    //     ]);
    // }

    /**
     * @Route("/{event}/show", name="caif_shared_event_show")
     */
    public function showAction(Event $event, Request $request)
    {
        $form = null;
        if ($event->isRsvp()) {
            $rsvp = new Rsvp();
            $rsvp->setEvent($event);

            if ($this->getUser()) {
                $rsvp->setPerson($this->getUser());
                $rsvp->setName((string)$this->getUser());
                $rsvp->setEmail($this->getUser()->getEmail());
            }

            $form = $this->createForm('rsvp', $rsvp);

            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                /* quick check to make sure not a dupe */
                $repository = $em->getRepository('CAIFSharedBundle:RSVP');
                $person     = $repository->createQueryBuilder('r')
                    ->select('r')
                    ->where('r.event = :event')
                    ->andWhere('r.person = :person OR r.email = :email')
                    ->setParameter('event', $event)
                    ->setParameter('person', $this->getUser())
                    ->setParameter('email', $rsvp->getEmail())
                    ->getQuery()
                    ->getOneOrNullResult();

                if ($person !== null) {
                    $this->addFlash('warning', 'Looks like you have RSVP\'d to this event already');
                    return $this->redirectToRoute('caif_shared_event_show', [
                        'event' => $event->getId(),
                    ]);
                }

                $em->persist($rsvp);
                $em->flush();

                /* generate calendar attachment */
                $ical = "BEGIN:VCALENDAR\r\n
                    VERSION:2.0\r\n
                    PRODID:-//hacksw/handcal//NONSGML v1.0//EN\r\n
                    BEGIN:VEVENT\r\n
                    UID:".md5(uniqid(mt_rand(), true))."@caif@caifclemson.org\r\n
                    DTSTAMP:".gmdate('Ymd').'T'.gmdate('His')."Z\r\n
                    DTSTART:".$event->getStartDate()->format('Ymd')."T".gmdate('His', strtotime($event->getStartTime()))."Z\r\n
                    DTEND:".$event->getEndDate()->format('Ymd')."T".gmdate('His', strtotime($event->getEndTime()))."Z\r\n
                    SUMMARY:".$event->getTitle()."\r\n
                    END:VEVENT\r\n
                    END:VCALENDAR";

                $attachment = \Swift_Attachment::newInstance()
                    ->setFilename('CAIF-event-'.$event->getId().'.ics')
                    ->setContentType('text/calendar')
                    ->setDisposition('inline')
                    ->setBody($ical);

                $rsvpLink = $this->generateUrl('caif_shared_event_rsvp_remove', ['rsvp' => $rsvp->getId()], true);

                /* send email */
                $subject = 'CAIF Event RSVP';
                $from    = ['caif@caifclemson.org' => 'CAIF Site'];
                $to      = $rsvp->getEmail();
                $replyTo = 'sccaif@gmail.com';
                $message = "<h3>".$event->getTitle()."</h3>
                        You have RSVP'd ".$rsvp->getRsvpOption()." to the event. To remove this rsvp, please follow the link here <a href='".$rsvpLink."'>".$rsvpLink."</a>";

                $emailService = $this->get('caif.shared.email');
                $emailService->sendEmail($subject, $from, $to, $message, $replyTo, $attachment);

                $this->addFlash('success', 'RSVP submitted');
                return $this->redirectToRoute('caif_shared_event_index');
            }

        }

        return $this->render('CAIFSharedBundle:Event:show.html.twig', [
            'event' => $event,
            'form'  => ($form === null ? null : $form->createView()),
        ]);
    }

    /**
     * @Route("/rsvp/{rsvp}/remove", name="caif_shared_event_rsvp_remove")
     */
    public function rsvpRemoveAction(Rsvp $rsvp)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($rsvp);
        $em->flush();

        $this->addFlash('warning', 'RSVP removed for event');
        return $this->redirectToRoute('caif_shared_event_index');
    }

    /**
     * @Route("/english-classes", name="caif_shared_event_english_classes")
     */
    public function englishClassesAction()
    {
        $em         = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('CAIFSharedBundle:EnglishClass');
        $classes    = $repository->findAll();

        return $this->render('CAIFSharedBundle:Event:englishClasses.html.twig', [
            'classes' => $classes,
        ]);
    }

    /**
     * @Route("/english-classes/{englishClass}/show", name="caif_shared_event_english_classes_show")
     */
    public function englishClassShowAction(EnglishClass $englishClass)
    {
        return $this->render('CAIFSharedBundle:Event:englishClassShow.html.twig', [
            'class' => $englishClass,
        ]);
    }

    /**
     * @Route("/international-club", name="caif_shared_event_intl_club")
     */
    public function internationalClubAction()
    {
        $em         = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('CAIFSharedBundle:InternationalClub');
        $clubs      = $repository->findAll();

        return $this->render('CAIFSharedBundle:Event:internationalClubs.html.twig', [
            'clubs' => $clubs,
        ]);
    }

    /**
     * @Route("/international-club/{club}/show", name="caif_shared_event_intl_club_show")
     */
    public function internationalClubShowAction(InternationalClub $club)
    {
        return $this->render('CAIFSharedBundle:Event:internationalClubShow.html.twig', [
            'club' => $club,
        ]);
    }

    /**
     * @Route("/international-wives-club", name="caif_shared_event_wives_club")
     */
    public function wivesClubAction()
    {
        return $this->render('CAIFSharedBundle:Event:wivesClub.html.twig');
    }
}
