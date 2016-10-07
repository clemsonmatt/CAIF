<?php

namespace CAIF\ManageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use CAIF\SharedBundle\Entity\InternationalClub;

/**
 * @Route("/manage/international-club")
 */
class InternationalClubController extends Controller
{
    /**
     * @Route("/", name="caif_manage_intl_club_index")
     */
    public function indexAction()
    {
        $em         = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('CAIFSharedBundle:InternationalClub');
        $clubs      = $repository->findAll();

        return $this->render('CAIFManageBundle:InternationalClub:index.html.twig', [
            'clubs' => $clubs,
        ]);
    }

    /**
     * @Route("/{club}/show", name="caif_manage_intl_club_show")
     */
    public function showAction(InternationalClub $club)
    {
        return $this->render('CAIFManageBundle:InternationalClub:show.html.twig', [
            'club' => $club,
        ]);
    }

    /**
     * @Route("/add", name="caif_manage_intl_club_add")
     */
    public function addAction(Request $request)
    {
        $club = new InternationalClub();

        $form = $this->createForm('international_club', $club);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($club);
            $em->flush();

            $this->addFlash('success', 'International Club added');
            return $this->redirectToRoute('caif_manage_intl_club_index');
        }

        return $this->render('CAIFManageBundle:InternationalClub:addEdit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{club}/edit", name="caif_manage_intl_club_edit")
     */
    public function editAction(InternationalClub $club, Request $request)
    {
        $form = $this->createForm('international_club', $club);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->addFlash('success', 'International Club saved');
            return $this->redirectToRoute('caif_manage_intl_club_index');
        }

        return $this->render('CAIFManageBundle:InternationalClub:addEdit.html.twig', [
            'form' => $form->createView(),
            'club' => $club,
        ]);
    }

    /**
     * @Route("/{club}/remove", name="caif_manage_intl_club_remove")
     */
    public function removeAction(InternationalClub $club)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($club);
        $em->flush();

        $this->addFlash('warning', 'International Club removed');
        return $this->redirectToRoute('caif_manage_intl_club_index');
    }
}
