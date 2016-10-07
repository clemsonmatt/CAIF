<?php

namespace CAIF\ManageBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * @Route("/manage")
 */
class ManageController extends BaseController
{
    /**
     * @Route("/", name="caif_manage_index")
     */
    public function indexAction()
    {
        $em         = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('CAIFSharedBundle:Student');
        $students   = $repository->findBy(['active' => true], ['lastName' => 'ASC']);

        $repository = $em->getRepository('CAIFSharedBundle:Host');
        $hosts      = $repository->findBy([
            'hosting' => true,
            'active'  => true,
        ], [
            'name' => 'ASC'
        ]);

        $members = $repository->findBy([
            'hosting' => false,
            'active'  => true,
        ], [
            'name' => 'ASC'
        ]);

        $repository = $em->getRepository('CAIFSharedBundle:Person');
        $archived   = $repository->findBy(['active' => false]);

        return $this->render('CAIFManageBundle:Manage:index.html.twig', [
            'students'    => $students,
            'hosts'       => $this->sortHostByLastName($hosts),
            'members'     => $this->sortHostByLastName($members),
            'archived'    => $archived,
        ]);
    }

    /**
     * @Route("/host-printable", name="caif_manage_host_printable")
     */
    public function hostPrintable()
    {
        $em         = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('CAIFSharedBundle:Host');
        $hosts      = $repository->findBy([
            'hosting' => true,
            'active'  => true,
        ], [
            'name' => 'ASC'
        ]);

        return $this->render('CAIFManageBundle:Manage:hostPrintable.html.twig', [
            'hosts' => $this->sortHostByLastName($hosts),
        ]);
    }

    /**
     * @Route("/download/{type}", name="caif_manage_download")
     */
    public function downloadAction($type)
    {
        $em = $this->getDoctrine()->getManager();

        $filename = $type.'_'.date('m-d-Y');

        switch ($type) {
            case 'students':
                $repository = $em->getRepository('CAIFSharedBundle:Student');
                $people     = $repository->findBy([
                    'active' => true,
                ]);
                break;

            case 'hosts':
                $repository = $em->getRepository('CAIFSharedBundle:Host');
                $people     = $repository->findBy([
                    'active'  => true,
                    'hosting' => true,
                ]);

                $people = $this->sortHostByLastName($people);
                break;

            case 'community-members':
                $repository = $em->getRepository('CAIFSharedBundle:Host');
                $people     = $repository->findBy([
                    'active'  => true,
                    'hosting' => false,
                ]);

                $people = $this->sortHostByLastName($people);

                /* change type to host for twig template */
                $type = 'hosts';
                break;
        }

        $response = $this->render('CAIFManageBundle:Manage:'.$type.'Export.html.twig', [
            'people' => $people,
        ]);

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="'.$filename.'.csv"');

        return $response;
    }

    /**
     * @Route("/search-person/{query}")
     */
    public function searchPersonAction($query)
    {
        $em          = $this->getDoctrine()->getManager();
        $hostResults = $em->getRepository('CAIFSharedBundle:Host')->createQueryBuilder('h')
            ->where('h.name LIKE :query')
            ->setParameter('query', '%'.$query.'%')
            ->getQuery()
            ->getResult();

        $people = [];
        foreach ($hostResults as $result) {
            $people[] = [
                'name' => $result->getName().' - '.$result->getEntityType(),
                'id'   => $result->getId(),
                'type' => $result->getEntityType(),
            ];
        }

        $studentResults = $em->getRepository('CAIFSharedBundle:Student')->createQueryBuilder('s')
            ->where('s.firstName LIKE :query OR s.lastName LIKE :query')
            ->setParameter('query', '%'.$query.'%')
            ->getQuery()
            ->getResult();

        foreach ($studentResults as $result) {
            $people[] = [
                'name' => $result->getFirstName().' '.$result->getLastName().' - '.$result->getEntityType(),
                'id'   => $result->getId(),
                'type' => $result->getEntityType(),
            ];
        }

        return new JsonResponse($people);
    }
}
