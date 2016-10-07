<?php

namespace CAIF\SharedBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use CAIF\SharedBundle\Entity\Student;

/**
 * @Route("/students")
 */
class StudentController extends Controller
{
    /**
     * @Route("/form", name="caif_shared_student_form")
     */
    public function formAction(Request $request)
    {
        $student = new Student();
        $student->setRoles(['ROLE_USER']);

        $form = $this->createForm('student_form', $student, [
            'show_login' => true,
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
                $student->setPhoto($picture_path);
            }

            /* encode password with bcrypt */
            $factory  = $this->get('security.encoder_factory');
            $encoder  = $factory->getEncoder($student);
            $password = $encoder->encodePassword($form['password']->getData(), $student->getSalt());

            $student->setPassword($password);

            $student->setActive(true);

            $em = $this->getDoctrine()->getManager();
            $em->persist($student);
            $em->flush();

            /* send emails */
            $emailService = $this->get('caif.shared.email');
            $emailService->newStudent($student);

            $this->addFlash('success', 'Submission Successful');
            return $this->redirectToRoute('caif_shared_student_guidelines');
        }

        return $this->render('CAIFSharedBundle:Student:form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/guidelines", name="caif_shared_student_guidelines")
     */
    public function guidelinesAction()
    {
        return $this->render('CAIFSharedBundle:Student:guidelines.html.twig');
    }
}
