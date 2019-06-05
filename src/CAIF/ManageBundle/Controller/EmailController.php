<?php

namespace CAIF\ManageBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use CAIF\SharedBundle\Entity\Email;
use CAIF\SharedBundle\Entity\Event;

/**
 * @Route("/manage/email")
 */
class EmailController extends Controller
{
    /**
     * @Route("/", name="caif_manage_email_index")
     */
    public function indexAction()
    {
        $em         = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('CAIFSharedBundle:Email');
        $emails     = $repository->findBy([], ['createdAt' => 'DESC']);

        return $this->render('CAIFManageBundle:Email:index.html.twig', [
            'emails' => $emails,
        ]);
    }

    /**
     * @Route("/{email}/show", name="caif_manage_email_show")
     */
    public function showAction(Email $email)
    {
        return $this->render('CAIFManageBundle:Email:show.html.twig', [
            'email' => $email,
        ]);
    }

    /**
     * @Route("/add/{event}", name="caif_manage_email_add", defaults={"eventId" = null})
     */
    public function addAction(Request $request, Event $event = null)
    {
        $email = new Email();
        $form  = $this->createForm('email', $email, [
            'event' => $event,
        ]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($email);
            $em->flush();

            $this->addFlash('info', 'Review email before sending');
            return $this->redirectToRoute('caif_manage_email_review', [
                'email' => $email->getId(),
                'event' => ($event !== null ? $event->getId() : null),
            ]);
        }

        return $this->render('CAIFManageBundle:Email:addEdit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{email}/edit/{event}", name="caif_manage_email_edit")
     */
    public function editAction(Email $email, Request $request, Event $event = null)
    {
        $form = $this->createForm('email', $email, [
            'event' => $event,
        ]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->addFlash('info', 'Review email before sending');
            return $this->redirectToRoute('caif_manage_email_review', [
                'email' => $email->getId(),
            ]);
        }

        return $this->render('CAIFManageBundle:Email:addEdit.html.twig', [
            'form'  => $form->createView(),
            'email' => $email,
        ]);
    }

    /**
     * @Route("/{email}/review/{event}", name="caif_manage_email_review")
     */
    public function reviewAction(Email $email, Event $event = null)
    {
        $sendTo = $this->getToAddresses($email->getTo());

        return $this->render('CAIFManageBundle:Email:review.html.twig', [
            'email'   => $email,
            'event'   => $event,
            'send_to' => $sendTo,
        ]);
    }

    /**
     * @Route("/{email}/send", name="caif_manage_email_send")
     */
    public function sendAction(Email $email)
    {
        $this->sendEmail($email);

        $this->addFlash('success', 'Email sent');
        return $this->redirectToRoute('caif_manage_email_index');
    }

    /**
     * @Route("/test")
     */
    public function sendTestEmail()
    {
        $email = new Email();
        $email->setTo('Test');
        $email->setSubject('Testing');
        $email->setMessage('This is a test');

        $this->sendEmail($email);

        $this->addFlash('success', 'Test email sent');
        return $this->redirectToRoute('caif_manage_email_index');
    }


    /**
     * Send email
     */
    private function sendEmail(Email $email)
    {
        $sendTo = $this->getToAddresses($email->getTo());

        $message = \Swift_Message::newInstance()
            ->setSubject($email->getSubject())
            ->setFrom(['caif@caifclemson.org' => 'CAIF'])
            ->setBcc($sendTo)
            ->setReplyTo('sccaif@gmail.com')
            ->setBody(
                $this->get('templating')->render('CAIFSharedBundle:Email:template.html.twig', [
                    'subject' => $email->getSubject(),
                    'message' => $email->getMessage(),
                ]),
                'text/html'
            )
            ->setContentType("text/html");
        $this->get('mailer')->send($message);
    }

    /**
     * Get email address list
     */
    private function getToAddresses($emailTo)
    {
        $em                = $this->getDoctrine()->getManager();
        $personRepository  = $em->getRepository('CAIFSharedBundle:Person');
        $hostRepository    = $em->getRepository('CAIFSharedBundle:Host');
        $studentRepository = $em->getRepository('CAIFSharedBundle:Student');

        switch ($emailTo) {
            case 'Test':
                $sendTo = ['mellis0292@gmail.com', 'mlellis@clemson.edu', 'mellis@ncees.org'];
                break;

            case 'All':
                $hostResult    = $hostRepository->findBy(['active' => true]);
                $studentResult = $studentRepository->findBy(['active' => true]);

                $result = array_merge($hostResult, $studentResult);
                break;

            case 'All Students':
                $result = $studentRepository->findBy(['active' => true]);
                break;

            case 'Students with host':
                $result = $studentRepository->createQueryBuilder('s')
                    ->where('s.active = :true')
                    ->andWhere('s.host IS NOT NULL')
                    ->andWhere('s.hostNotNeeded = :false')
                    ->setParameter('true', true)
                    ->setParameter('false', false)
                    ->getQuery()
                    ->getResult();
                break;

            case 'Students without hosts':
                $result = $studentRepository->findBy([
                    'active'        => true,
                    'host'          => null,
                    'hostNotNeeded' => false,
                ]);
                break;

            case 'Students with host not needed':
                $result = $studentRepository->findBy([
                    'active'        => true,
                    'hostNotNeeded' => true,
                ]);
                break;

            case 'All Community Members':
                $result = $hostRepository->findBy(['active' => true]);
                break;

            case 'Only Community Members that host':
                $result = $hostRepository->findBy([
                    'hosting' => true,
                    'active'  => true,
                ]);
                break;

            case 'Only Community Members that do not host':
                $result = $hostRepository->findBy([
                    'hosting' => false,
                    'active'  => true,
                ]);
                break;

            /* email rsvp list */
            default:
                /* get id of event */
                $emailTo = explode(" RSVP List", $emailTo);
                $emailTo = explode("Event ", $emailTo[0]);
                $eventId = $emailTo[1];

                /* get event entity */
                $eventRepository = $em->getRepository('CAIFSharedBundle:Event');
                $event           = $eventRepository->findOneById($eventId);

                /* get rsvp list */
                $result = $event->getRsvps();
                break;
        }

        if ($emailTo != 'Test') {
            $sendTo = [];
            foreach ($result as $person) {
                if ($person->getEmail() != "") {
                    $sendTo[] = $person->getEmail();
                }
            }
        }

        return $sendTo;
    }
}
