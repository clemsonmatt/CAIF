<?php

namespace CAIF\SharedBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use CAIF\SharedBundle\Entity\Person;

/**
 * @Route("/profile")
 */
class ProfileController extends Controller
{
    /**
     * @Route("/community-member/{person}/show", name="caif_shared_profile_host")
     * @Security("is_granted('caif-profile', person)")
     */
    public function hostAction(Person $person)
    {
        return $this->render('CAIFSharedBundle:Profile:host.html.twig', [
            'person' => $person,
        ]);
    }

    /**
     * @Route("/student/{person}/show", name="caif_shared_profile_student")
     * @Security("is_granted('caif-profile', person)")
     */
    public function studentAction(Person $person)
    {
        return $this->render('CAIFSharedBundle:Profile:student.html.twig', [
            'person' => $person,
        ]);
    }

    /**
     * @Route("/community-member/{person}/edit", name="caif_shared_profile_member_edit")
     * @Security("is_granted('caif-profile', person)")
     */
    public function editHostAction(Person $person, Request $request)
    {
        $hosting    = $person->isHosting();
        $numHosting = count($person->getStudents());

        $form = $this->createForm('host_form', $person, [
            'show_login'     => false,
            'show_reference' => false,
        ]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            /* upload profile picture */
            if ($form['picture']->getData() !== null) {
                $picture      = $form['picture']->getData();
                $extension    = $picture->guessExtension();
                $orgName      = str_replace(" ", "", $picture->getClientOriginalName());
                $orgName      = str_replace("#", "", $orgName);
                $picture_name = str_replace('.'.$extension, "", $orgName);
                $picture_path = $picture_name.'-'.time().'.'.$extension;
                $picture->move('uploads', $picture_path);
                $person->setPhoto($picture_path);
            }

            $studentsList = null;

            /* check if no longer hosting */
            if ($hosting == true && $person->isHosting() == false && count($person->getStudents()) > 0) {
                /* get the students and notify kathy */
                $students = [];
                foreach ($person->getStudents() as $student) {
                    $students[] = (string)$student;

                    /* remove host from student */
                    $student->setHost(null);
                }

                $studentsList = implode(", ", $students);

            } elseif ($numHosting > $person->getMaxStudents()) {
                /* they changed their max number to host below the number they are currently hosting */
                $students = [];
                $counter  = 1;
                foreach ($person->getStudents() as $student) {
                    if ($counter > $person->getMaxStudents()) {
                        $students[] = (string)$student;
                        $student->setHost(null);
                    }

                    $counter++;
                }

                $studentsList = implode(", ", $students);
            }

            /* send email if there were dropped students */
            if ($studentsList) {
                $emailService = $this->get('caif.shared.email');
                $emailService->hostingChange($person, $studentsList);
            }

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->addFlash('success', 'Profile updated.');
            return $this->redirectToRoute('caif_shared_profile_host', [
                'person' => $person->getId(),
            ]);
        }

        return $this->render('CAIFSharedBundle:Profile:hostEdit.html.twig', [
            'form'   => $form->createView(),
            'person' => $person,
        ]);
    }

    /**
     * @Route("/student/{person}/edit", name="caif_shared_profile_student_edit")
     * @Security("is_granted('caif-profile', person)")
     */
    public function editStudentAction(Person $person, Request $request)
    {
        $form = $this->createForm('student_form', $person, [
            'show_login' => false,
        ]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            /* upload profile picture */
            if ($form['picture']->getData() !== null) {
                $picture      = $form['picture']->getData();
                $extension    = $picture->guessExtension();
                $orgName      = str_replace(" ", "", $picture->getClientOriginalName());
                $orgName      = str_replace("#", "", $orgName);
                $picture_name = str_replace('.'.$extension, "", $orgName);
                $picture_path = $picture_name.'-'.time().'.'.$extension;
                $picture->move('uploads', $picture_path);
                $person->setPhoto($picture_path);
            }

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->addFlash('success', 'Profile updated.');
            return $this->redirectToRoute('caif_shared_profile_student', [
                'person' => $person->getId(),
            ]);
        }

        return $this->render('CAIFSharedBundle:Profile:studentEdit.html.twig', [
            'form'   => $form->createView(),
            'person' => $person,
        ]);
    }

    /**
     * @Route("/student/{person}/host-profile", name="caif_shared_profile_student_host")
     * @Security("is_granted('caif-profile', person)")
     */
    public function hostProfileAction(Person $person)
    {
        return $this->render('CAIFSharedBundle:Profile:studentHostProfile.html.twig', [
            'person' => $person,
        ]);
    }

    /**
     * @Route("/community-member/{person}/student-profiles", name="caif_shared_profile_host_student")
     * @Security("is_granted('caif-profile', person)")
     */
    public function studentProfileAction(Person $person)
    {
        return $this->render('CAIFSharedBundle:Profile:hostStudentProfile.html.twig', [
            'person' => $person,
        ]);
    }

    /**
     * @Route("/{person}/change-password", name="caif_shared_profile_password_change")
     * @Security("is_granted('caif-profile', person)")
     */
    public function passwordAction(Person $person, Request $request)
    {
        $form = $this->createForm('change_password');

        $form->handleRequest($request);

        if ($form->isValid()) {
            /* encrypt the password */
            $factory     = $this->get('security.encoder_factory');
            $encoder     = $factory->getEncoder($person);
            $newPassword = $encoder->encodePassword($form['newPassword']->getData(), $person->getSalt());

            $person->setPassword($newPassword);
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->addFlash('success', 'Password changed');
        }

        return $this->render('CAIFSharedBundle:Profile:changePassword.html.twig', [
            'form'   => $form->createView(),
            'person' => $person,
        ]);
    }

    /**
     * New password if user forgot
     *
     * @Route("/updatePassword/{tempPass}", name="caif_shared_profile_updatePassword")
     */
    public function updatePasswordAction(Request $request, $tempPass)
    {
        if ($this->getUser()->getTempPassword() != md5($tempPass)) {
            throw new NotFoundHttpException("Page not found");
        }

        /* get password form */
        $form = $this->createForm('forgot_password');

        $form->handleRequest($request);

        if ($form->isValid()) {
            $person = $this->getUser();

            /* encrypt the password */
            $factory     = $this->get('security.encoder_factory');
            $encoder     = $factory->getEncoder($person);
            $newPassword = $encoder->encodePassword($form['newPassword']->getData(), $person->getSalt());

            /* add to the db */
            $person->setPassword($newPassword);
            $person->setUpdatedPassword(true);
            $person->setTempPassword(null);
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            /* store flash message */
            $this->addFlash('success', 'Your password has been changed');

            return $this->redirectToRoute('caif_shared_index');
        }

        return $this->render('CAIFSharedBundle:Profile:updatePassword.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{person}/archive", name="caif_shared_profile_archive")
     */
    public function archiveAction(Person $person)
    {
        $person->setActive(false);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        if ($person->getEntityType() == "Student") {
            $this->addFlash('warning', 'Student archived');
            return $this->redirectToRoute('caif_shared_profile_student', [
                'person' => $person->getId(),
            ]);
        }

        $this->addFlash('warning', 'Host archived');
        return $this->redirectToRoute('caif_shared_profile_host', [
            'person' => $person->getId(),
        ]);
    }

    /**
     * @Route("/{person}/unarchive", name="caif_shared_profile_unarchive")
     */
    public function unarchiveAction(Person $person)
    {
        $person->setActive(true);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        if ($person->getEntityType() == "Student") {
            $this->addFlash('success', 'Student activated');
            return $this->redirectToRoute('caif_shared_profile_student', [
                'person' => $person->getId(),
            ]);
        }

        $this->addFlash('success', 'Host activated');
        return $this->redirectToRoute('caif_shared_profile_host', [
            'person' => $person->getId(),
        ]);
    }
}
