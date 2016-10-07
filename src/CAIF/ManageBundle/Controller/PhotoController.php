<?php

namespace CAIF\ManageBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use CAIF\SharedBundle\Entity\Photo;
use CAIF\SharedBundle\Entity\PhotoAlbum;

/**
 * @Route("/manage/{album}/photo")
 */
class PhotoController extends Controller
{
    /**
     * @Route("/add", name="caif_manage_photo_add")
     */
    public function addActivity(PhotoAlbum $album, Request $request)
    {
        $photo = new Photo();
        $photo->setAlbum($album);

        $form = $this->createForm('caif_photo', $photo);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $photo->upload();

            $em->persist($photo);
            $em->flush();

            $this->addFlash('success', 'Photo added to '.$album);
            return $this->redirectToRoute('caif_manage_photo_album_show', [
                'album' => $album->getId(),
            ]);
        }

        return $this->render('CAIFManageBundle:Photo:addEditPhoto.html.twig', [
            'form'  => $form->createView(),
            'album' => $album,
        ]);
    }

    /**
     * @Route("/{photo}/remove", name="caif_manage_photo_remove")
     */
    public function removeAction(PhotoAlbum $album, Photo $photo)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($photo);
        $em->flush();

        $this->addFlash('warning', 'Photo removed');
        return $this->redirectToRoute('caif_manage_photo_album_show', [
            'album' => $album->getId(),
        ]);
    }
}
