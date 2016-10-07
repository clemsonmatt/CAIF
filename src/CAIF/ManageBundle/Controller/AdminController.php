<?php

namespace CAIF\ManageBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use CAIF\SharedBundle\Entity\Person;

/**
 * @Route("/manage/admins")
 * @Security("has_role('ROLE_SUPER_ADMIN')")
 */
class AdminController extends Controller
{
    /**
     * @Route("/", name="caif_manage_admins_index")
     */
    public function indexAction()
    {
        $em         = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('CAIFSharedBundle:Host');
        $hosts      = $repository->findBy(['active' => true]);

        $admins    = [];
        $nonAdmins = [];

        foreach ($hosts as $host) {
            if (in_array('ROLE_ADMIN', $host->getRoles())) {
                $admins[] = $host;
            } else {
                $nonAdmins[] = $host;
            }
        }

        return $this->render('CAIFManageBundle:Admin:index.html.twig', [
            'admins'    => $admins,
            'nonAdmins' => $nonAdmins,
        ]);
    }

    /**
     * @Route("/{person}/add", name="caif_manage_admins_add")
     */
    public function addAction(Person $person)
    {
        $roles = $person->getRoles();

        array_push($roles, 'ROLE_ADMIN');

        $person->setRoles($roles);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        $this->addFlash('success', 'Admin added');
        return $this->redirectToRoute('caif_manage_admins_index');
    }

    /**
     * @Route("/{person}/remove", name="caif_manage_admins_remove")
     */
    public function removeAction(Person $person)
    {
        $person->setRoles(['ROLE_USER']);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        $this->addFlash('warning', 'Admin removed');
        return $this->redirectToRoute('caif_manage_admins_index');
    }
}
