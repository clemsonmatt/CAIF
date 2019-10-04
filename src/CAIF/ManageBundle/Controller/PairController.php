<?php

namespace CAIF\ManageBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use CAIF\SharedBundle\Entity\Host;
use CAIF\SharedBundle\Entity\PairEmail;
use CAIF\SharedBundle\Entity\Student;

/**
 * @Route("/manage/pair")
 */
class PairController extends BaseController
{
    /**
     * @Route("/", name="caif_manage_pair_index")
     */
    public function indexAction()
    {
        /* find available hosts */
        $hostStatus = $this->findHostStatus();

        $em               = $this->getDoctrine()->getManager();
        $repository       = $em->getRepository('CAIFSharedBundle:Student');
        $unpairedStudents = $repository->findBy([
            'host'          => null,
            'hostNotNeeded' => false,
            'active'        => true,
        ], [
            'createdAt' => 'asc'
        ]);

        $hostNotNeededStudents = $repository->findBy([
            'hostNotNeeded' => true,
            'active'        => true,
        ], [
            'lastName' => 'asc'
        ]);

        $repository     = $em->getRepository('CAIFSharedBundle:PairEmail');
        $recentlyPaired = $repository->findBySent(false);

        return $this->render('CAIFManageBundle:Pair:index.html.twig', [
            'unpaired_students'        => $unpairedStudents,
            'available_hosts'          => $this->sortHostByLastName($hostStatus['available']),
            'unavailable_hosts'        => $this->sortHostByLastName($hostStatus['unavaiable']),
            'host_not_needed_students' => $hostNotNeededStudents,
            'recently_paired'          => $recentlyPaired,
        ]);
    }

    /**
     * @Route("/host/{host}", name="caif_manage_pair_host_add")
     */
    public function pairHostAddAction(Host $host)
    {
        $em               = $this->getDoctrine()->getManager();
        $repository       = $em->getRepository('CAIFSharedBundle:Student');
        $unpairedStudents = $repository->findBy([
            'host'          => null,
            'hostNotNeeded' => false,
            'active'        => true,
        ], [
            'createdAt' => 'asc'
        ]);

        return $this->render('CAIFManageBundle:Pair:hostAdd.html.twig', [
            'unpaired_students' => $unpairedStudents,
            'host'              => $host,
        ]);
    }

    /**
     * @Route("/student/{student}", name="caif_manage_pair_student_add")
     */
    public function pairStudentAddAction(Student $student)
    {
        /* find available hosts */
        $hostStatus = $this->findHostStatus();

        return $this->render('CAIFManageBundle:Pair:studentAdd.html.twig', [
            'student'         => $student,
            'available_hosts' => $this->sortHostByLastName($hostStatus['available']),
        ]);
    }

    /**
     * @Route("/host/{host}/student/{student}/add/{currentSection}", name="caif_manage_pair_add", defaults={"currentSection": "host"}, requirements={"currentSection": "host|student"})
     */
    public function pairAction(Host $host, Student $student, $currentSection)
    {
        $student->setHost($host);

        $em = $this->getDoctrine()->getManager();

        /* check to see if host is in table already as not sent */
        $repository = $em->getRepository('CAIFSharedBundle:PairEmail');
        $pairEmail  = $repository->findOneBy([
            'host' => $host,
            'sent' => false,
        ]);

        if (! $pairEmail) {
            /* add host & student to pairEmail list */
            $pairEmail = new PairEmail();
            $pairEmail->setHost($host);
            $pairEmail->setStudents([$student]);
            $em->persist($pairEmail);
        } else {
            /* add student to students field */
            $students   = $pairEmail->getStudents();

            if (! in_array($student, $students)) {
                $students[] = $student;
            }

            $pairEmail->setStudents($students);
        }

        $em->flush();

        $this->addFlash('success', (string)$student.' paired with '.(string)$host);

        if ($currentSection == 'student') {
            return $this->redirectToRoute('caif_manage_pair_student_add', [
                'student' => $student->getId(),
            ]);
        }

        return $this->redirectToRoute('caif_manage_pair_host_add', [
            'host' => $host->getId(),
        ]);
    }

    /**
     * @Route("/host/{host}/student/{student}/remove/{currentSection}", name="caif_manage_pair_remove", defaults={"currentSection": "host"}, requirements={"currentSection": "host|student"})
     */
    public function pairRemoveAction(Host $host, Student $student, $currentSection)
    {
        /* remove from pair email list */
        $em         = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('CAIFSharedBundle:PairEmail');
        $pairEmail  = $repository->findOneBy([
            'host' => $host,
            'sent' => false,
        ]);

        $students = [];
        if ($pairEmail) {
            foreach ($pairEmail->getStudents() as $s) {
                if ($s->getId() != $student->getId()) {
                    $students[] = $s;
                }
            }
        }

        if (count($students)) {
            $pairEmail->setStudents($students);
        } elseif ($pairEmail) {
            $em->remove($pairEmail);
        }

        /* release student from host */
        $student->setHost(null);

        $em->flush();

        $this->addFlash('warning', (string)$student.' unpaired from '.(string)$host);

        if ($currentSection == 'student') {
            return $this->redirectToRoute('caif_manage_pair_student_add', [
                'student' => $student->getId(),
            ]);
        }

        return $this->redirectToRoute('caif_manage_pair_host_add', [
            'host' => $host->getId(),
        ]);
    }

    /**
     * @Route("/student/{student}/host-not-needed", name="caif_manage_pair_host_not_needed")
     */
    public function hostNotNeededAction(Student $student)
    {
        $student->setHostNotNeeded(true);
        $student->setHost(null);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        $this->addFlash('warning', 'Changed student to host not needed');

        return $this->redirectToRoute('caif_manage_pair_student_add', [
            'student' => $student->getId(),
        ]);
    }

    /**
     * @Route("/student/{student}/host-needed", name="caif_manage_pair_host_needed")
     */
    public function hostNeededAction(Student $student)
    {
        $student->setHostNotNeeded(false);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        $this->addFlash('warning', 'Changed student to host needed');

        return $this->redirectToRoute('caif_manage_pair_student_add', [
            'student' => $student->getId(),
        ]);
    }

    /**
     * @Route("/send-emails", name="caif_manage_pair_send_emails")
     */
    public function sendEmailsAction()
    {
        $em           = $this->getDoctrine()->getManager();
        $repository   = $em->getRepository('CAIFSharedBundle:PairEmail');
        $pairedEmails = $repository->findBySent(false);

        $sendToHost    = [];
        $sendToStudent = [];

        foreach ($pairedEmails as $pairedEmail) {
            $sendToHost[] = $pairedEmail->getHost()->getEmail();
            if ($secondaryEmail = $pairedEmail->getHost()->getSecondaryEmail()) {
                $sendToHost[] = $secondaryEmail;
            }

            foreach ($pairedEmail->getStudents() as $s) {
                $sendToStudent[] = $s->getEmail();
            }

            $pairedEmail->setSent(true);
        }

        $em->flush();

        $hostMessage    = "A student was recently paired with you. Login to your caifclemson.org account to view more.";
        $studentMessage = "You were recently paired with a host. Login to your caifclemson.org account to view more.";

        $emailService = $this->get('caif.shared.email');
        $emailService->sendEmail('Student Paired', ['noreply@caifclemson.org' => 'CAIF Site'], $sendToHost, $hostMessage);
        $emailService->sendEmail('Paired with host', ['noreply@caifclemson.org' => 'CAIF Site'], $sendToStudent, $studentMessage);

        $this->addFlash('success', 'Pairing emails sent');
        return $this->redirectToRoute('caif_manage_pair_index');
    }


    /**
     * Find available and unavaiable hosts
     */
    private function findHostStatus()
    {
        $em         = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('CAIFSharedBundle:Host');
        $hosts      = $repository->findBy([
            'hosting' => true,
            'active'  => true,
        ], [
            'name' => 'asc'
        ]);

        $availableHosts  = [];
        $unavaiableHosts = [];

        foreach ($hosts as $host) {
            if (count($host->getStudents()) < $host->getMaxStudents()) {
                $availableHosts[] = $host;
            } else {
                $unavaiableHosts[] = $host;
            }
        }

        return [
            'available'  => $availableHosts,
            'unavaiable' => $unavaiableHosts,
        ];
    }
}
