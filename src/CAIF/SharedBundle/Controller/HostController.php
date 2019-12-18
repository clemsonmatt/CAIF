<?php

namespace CAIF\SharedBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use CAIF\SharedBundle\Entity\Host;

/**
 * @Route("/community-members")
 */
class HostController extends Controller
{
    /**
     * @Route("/form", name="caif_shared_host_form")
     */
    public function formAction(Request $request)
    {
        $host = new Host();
        $host->setRoles(['ROLE_USER']);
        $host->setState('SC');

        $form = $this->createForm('host_form', $host, [
            'show_login'     => true,
            'show_reference' => true,
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
                $host->setPhoto($picture_path);
            }

            /* encode password with bcrypt */
            $factory  = $this->get('security.encoder_factory');
            $encoder  = $factory->getEncoder($host);
            $password = $encoder->encodePassword($form['password']->getData(), $host->getSalt());
            $host->setPassword($password);

            $host->setActive(true);

            $em = $this->getDoctrine()->getManager();
            $em->persist($host);
            $em->flush();

            /* send emails */
            $emailService = $this->get('caif.shared.email');
            $emailService->newHost($host);

            $this->addFlash('success', 'Submission successful');
            return $this->redirectToRoute('caif_shared_host_guidelines');
        }

        return $this->render('CAIFSharedBundle:Host:form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/guidelines", name="caif_shared_host_guidelines")
     */
    public function guidelinesAction()
    {
        return $this->render('CAIFSharedBundle:Host:guidelines.html.twig');
    }

    /**
     * @Route("/activity", name="caif_shared_host_activity")
     */
    public function activityAction()
    {
        return $this->render('CAIFSharedBundle:Host:activity.html.twig');
    }

    /**
     * @Route("/conversation-starters", name="caif_shared_host_conversation")
     */
    public function conversationAction()
    {
        return $this->render('CAIFSharedBundle:Host:conversation.html.twig');
    }

    /**
     * @Route("/what-to-serve", name="caif_shared_host_serve")
     */
    public function serveAction()
    {
        $em         = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('CAIFSharedBundle:Recipe');
        $recipes    = $repository->findAll();

        return $this->render('CAIFSharedBundle:Host:serve.html.twig', [
            'recipes' => $recipes,
        ]);
    }
}
