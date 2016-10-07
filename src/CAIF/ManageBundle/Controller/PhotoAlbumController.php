<?php

namespace CAIF\ManageBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use CAIF\SharedBundle\Entity\PhotoAlbum;

/**
 * @Route("/manage/photo-album")
 */
class PhotoAlbumController extends Controller
{
    /**
     * @Route("/", name="caif_manage_photo_index")
     */
    public function indexAction()
    {
        $em         = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('CAIFSharedBundle:PhotoAlbum');
        $albums     = $repository->findAll();

        return $this->render('CAIFSharedBundle:Photo:index.html.twig', [
            'albums'    => $albums,
            'manage'    => true,
            'show_path' => 'caif_manage_photo_album_show',
        ]);
    }

    /**
     * @Route("/album/{album}/show", name="caif_manage_photo_album_show")
     */
    public function showActivity(PhotoAlbum $album)
    {
        return $this->render('CAIFSharedBundle:Photo:show.html.twig', [
            'album'      => $album,
            'manage'     => true,
            'index_path' => 'caif_manage_photo_index',
        ]);
    }

    /**
     * @Route("/album/add", name="caif_manage_photo_album_add")
     */
    public function addActivity(Request $request)
    {
        $album = new PhotoAlbum();

        $form = $this->createForm('caif_photo_album', $album);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($album);
            $em->flush();

            $this->addFlash('success', 'Album added');
            return $this->redirectToRoute('caif_manage_photo_album_show', [
                'album' => $album->getId(),
            ]);
        }

        return $this->render('CAIFManageBundle:Photo:addEditAlbum.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/album/{album}/edit", name="caif_manage_photo_album_edit")
     */
    public function editActivity(PhotoAlbum $album, Request $request)
    {
        $form = $this->createForm('caif_photo_album', $album);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->addFlash('success', 'Album saved');
            return $this->redirectToRoute('caif_manage_photo_album_show', [
                'album' => $album->getId(),
            ]);
        }

        return $this->render('CAIFManageBundle:Photo:addEditAlbum.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/album/{album}/remove", name="caif_manage_photo_album_remove")
     */
    public function removeActivity(PhotoAlbum $album)
    {
        $em = $this->getDoctrine()->getManager();

        /* first remove the photos */
        foreach ($album->getPhotos() as $photo) {
            $em->remove($photo);
        }
        $em->flush();

        /* then remove album */
        $em->remove($album);
        $em->flush();

        $this->addFlash('warning', 'Album removed');
        return $this->redirectToRoute('caif_manage_photo_index');
    }
}
