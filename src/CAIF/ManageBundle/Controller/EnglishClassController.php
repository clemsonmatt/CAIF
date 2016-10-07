<?php

namespace CAIF\ManageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use CAIF\SharedBundle\Entity\EnglishClass;

/**
 * @Route("/manage/english-classes")
 */
class EnglishClassController extends Controller
{
    /**
     * @Route("/", name="caif_manage_english_class_index")
     */
    public function indexAction()
    {
        $em         = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('CAIFSharedBundle:EnglishClass');
        $classes    = $repository->findAll();

        return $this->render('CAIFManageBundle:EnglishClass:index.html.twig', [
            'classes' => $classes,
        ]);
    }

    /**
     * @Route("/{englishClass}/show", name="caif_manage_english_class_show")
     */
    public function showAction(EnglishClass $englishClass)
    {
        return $this->render('CAIFManageBundle:EnglishClass:show.html.twig', [
            'class' => $englishClass,
        ]);
    }

    /**
     * @Route("/add", name="caif_manage_english_class_add")
     */
    public function addAction(Request $request)
    {
        $englishClass = new EnglishClass();

        $form = $this->createForm('english_class', $englishClass);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($englishClass);
            $em->flush();

            $this->addFlash('success', 'English Class added');
            return $this->redirectToRoute('caif_manage_english_class_index');
        }

        return $this->render('CAIFManageBundle:EnglishClass:addEdit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{englishClass}/edit", name="caif_manage_english_class_edit")
     */
    public function editAction(EnglishClass $englishClass, Request $request)
    {
        $form = $this->createForm('english_class', $englishClass);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->addFlash('success', 'English Class saved');
            return $this->redirectToRoute('caif_manage_english_class_index');
        }

        return $this->render('CAIFManageBundle:EnglishClass:addEdit.html.twig', [
            'form'  => $form->createView(),
            'class' => $englishClass,
        ]);
    }

    /**
     * @Route("/{englishClass}/remove", name="caif_manage_english_class_remove")
     */
    public function removeAction(EnglishClass $englishClass)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($englishClass);
        $em->flush();

        $this->addFlash('warning', 'English Class removed');
        return $this->redirectToRoute('caif_manage_english_class_index');
    }
}
