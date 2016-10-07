<?php

namespace CAIF\SharedBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use CAIF\SharedBundle\Entity\Message;
use CAIF\SharedBundle\Entity\PhotoAlbum;

/**
 * @Route("/")
 */
class CaifController extends Controller
{
    /**
     * @Route("/", name="caif_shared_index")
     */
    public function indexAction()
    {
        return $this->render('CAIFSharedBundle:Caif:index.html.twig');
    }

    /**
     * @Route("/test-email")
     */
    public function testEmailAction()
    {
        return $this->render('CAIFSharedBundle:Email:template.html.twig', [
            'subject' => 'Test subject',
            'message' => 'This is a testing message',
        ]);
    }

    /**
     * @Route("/login-route", name="caif_shared_login_target")
     */
    public function loginTargetAction()
    {
        /* check for if logged in */
        if (! $this->getUser()) {
            return $this->redirectToRoute('caif_shared_index');
        }

        /* check to see if user needs to update password */
        if (! $this->getUser()->isUpdatedPassword()) {
            /* make/set temp password */
            $factory        = $this->get('security.encoder_factory');
            $encoder        = $factory->getEncoder($this->getUser());
            $hash           = time();
            $hash           = md5($hash);
            $hash           = substr(str_shuffle($hash), 0, 8);
            $uniquePassword = 'CAIF-'.$hash;
            $newPassword    = md5($uniquePassword);
            $this->getUser()->setTempPassword($newPassword);

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->addFlash('info', 'Please update your password');

            return $this->redirectToRoute('caif_shared_profile_updatePassword', [
                'tempPass' => $uniquePassword,
            ]);
        }

        /* redirect to appropriate spot */
        if ($this->getUser()->getEntityType() == "Admin") {
            return $this->redirectToRoute('caif_manage_index');
        } elseif ($this->getUser()->getEntityType() == "Host") {
            return $this->redirectToRoute('caif_shared_profile_host', [
                'person' => $this->getUser()->getId(),
            ]);
        }

        return $this->redirectToRoute('caif_shared_profile_student', [
            'person' => $this->getUser()->getId(),
        ]);
    }

    /**
     * @Route("/contact-us", name="caif_shared_contact")
     */
    public function contactAction(Request $request)
    {
        $message = new Message();

        if ($this->getUser() !== null) {
            $message->setUserId($this->getUser()->getId());
            $message->setName((string)$this->getUser());
            if ($this->getUser()->getEntityType() != "Admin") {
                $message->setEmail($this->getUser()->getEmail());
            }
        }

        $form = $this->createForm('message', $message);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();

            /* send email */
            $emailService = $this->get('caif.shared.email');
            $emailService->sendContactMessage($message);

            $this->addFlash('success', 'Message sent.');
            return $this->redirectToRoute('caif_shared_index');
        }

        return $this->render('CAIFSharedBundle:Caif:contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/quotes", name="caif_shared_quotes")
     */
    public function quotesAction()
    {
        return $this->render('CAIFSharedBundle:Caif:quotes.html.twig');
    }

    /**
     * @Route("/officers", name="caif_shared_officers")
     */
    public function officersAction()
    {
        return $this->render('CAIFSharedBundle:Caif:officers.html.twig');
    }

    /**
     * @Route("/faq", name="caif_shared_faq")
     */
    public function faqAction()
    {
        return $this->render('CAIFSharedBundle:Caif:faq.html.twig');
    }

    /**
     * @Route("/site-map", name="caif_shared_site_map")
     */
    public function siteMapAction()
    {
        return $this->render('CAIFSharedBundle:Caif:siteMap.html.twig');
    }

    /**
     * @Route("/gallery", name="caif_shared_gallery")
     */
    public function galleryAction()
    {
        $em         = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('CAIFSharedBundle:PhotoAlbum');
        $albums     = $repository->findAll();

        return $this->render('CAIFSharedBundle:Photo:index.html.twig', [
            'albums'    => $albums,
            'manage'    => false,
            'show_path' => 'caif_shared_photo_album_show',
        ]);
    }

    /**
     * @Route("/gallery/{album}/show", name="caif_shared_photo_album_show")
     */
    public function galleryShowAction(PhotoAlbum $album)
    {
        return $this->render('CAIFSharedBundle:Photo:show.html.twig', [
            'album'      => $album,
            'manage'     => false,
            'index_path' => 'caif_shared_gallery',
        ]);
    }
}
