<?php

namespace CAIF\ManageBundle\Controller;

// use Pagerfanta\Adapter\DoctrineORMAdapter;
// use Pagerfanta\Pagerfanta;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use CAIF\SharedBundle\Entity\Event;
use CAIF\SharedBundle\Entity\Rsvp;

/**
 * @Route("/manage/event")
 */
class EventController extends Controller
{
    /**
     * @Route("/{page}", name="caif_manage_event_index", defaults={"page" = "1"}, requirements={"page" = "\d+"})
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

        return $this->render('CAIFManageBundle:Event:index.html.twig', [
            'events' => $events,
        ]);
    }

    /**
     * @Route("/past/{page}", name="caif_manage_event_past", defaults={"page" = "1"}, requirements={"page" = "\d+"})
     */
    // public function pastAction($page)
    // {
    //     $em           = $this->getDoctrine()->getManager();
    //     $repository   = $em->getRepository('CAIFSharedBundle:Event');
    //     $queryBuilder = $repository->createQueryBuilder('e')
    //         ->where('e.endDate < :today')
    //         ->setParameter('today', date('Y-m-d', strtotime('now')));

    //     $adapter    = new DoctrineORMAdapter($queryBuilder, false);
    //     $pagerfanta = new Pagerfanta($adapter);
    //     $pagerfanta->setMaxPerPage(5);
    //     $pagerfanta->setCurrentPage($page);

    //     return $this->render('CAIFManageBundle:Event:pastEvents.html.twig', [
    //         'events' => $pagerfanta->getCurrentPageResults(),
    //         'pager'  => $pagerfanta,
    //     ]);
    // }

    /**
     * @Route("/{event}/show", name="caif_manage_event_show")
     */
    public function showAction(Event $event)
    {
        /* find total number attending */
        $totalAttending = 0;
        if ($event->isRsvp()) {
            foreach ($event->getRsvps() as $rsvp) {
                $totalAttending++;
                if ($rsvp->getGuests() !== null) {
                    $totalAttending += $rsvp->getGuests();
                }
            }
        }

        return $this->render('CAIFManageBundle:Event:show.html.twig', [
            'event'           => $event,
            'total_attending' => $totalAttending,
        ]);
    }

    /**
     * @Route("/add", name="caif_manage_event_add")
     */
    public function addAction(Request $request)
    {
        $event = new Event();

        $form = $this->createForm('event', $event);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();

            $this->addFlash('success', 'Event created.');
            return $this->redirectToRoute('caif_manage_event_index');
        }

        return $this->render('CAIFManageBundle:Event:addEdit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{event}/edit", name="caif_manage_event_edit")
     */
    public function editAction(Event $event, Request $request)
    {
        $form = $this->createForm('event', $event);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->addFlash('success', 'Event updated.');
            return $this->redirectToRoute('caif_manage_event_index');
        }

        return $this->render('CAIFManageBundle:Event:addEdit.html.twig', [
            'form'  => $form->createView(),
            'event' => $event,
        ]);
    }

    /**
     * @Route("/{event}/remove", name="caif_manage_event_remove")
     */
    public function removeAction(Event $event)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($event);
        $em->flush();

        $this->addFlash('warning', 'Event removed');
        return $this->redirectToRoute('caif_manage_event_index');
    }

    /**
     * @Route("/rsvp/{rsvp}/remove", name="caif_manage_event_rsvp_remove")
     */
    public function rsvpRemoveAction(Rsvp $rsvp)
    {
        $event = $rsvp->getEvent();

        $em = $this->getDoctrine()->getManager();
        $em->remove($rsvp);
        $em->flush();

        $this->addFlash('warning', 'RSVP removed');
        return $this->redirectToRoute('caif_manage_event_show', [
            'event' => $event->getId(),
        ]);
    }
}
