<?php

namespace CAIF\SharedBundle\Security\User;

use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\NoResultException;

/**
 * @DI\Service("caif_shared.student_user_provider")
 */
class StudentUserProvider implements UserProviderInterface
{
    private $em;

    /**
     * @DI\InjectParams({
     *     "em" = @DI\Inject("doctrine.orm.default_entity_manager")
     * })
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function loadUserByUsername($username)
    {
        $repository = $this->em->getRepository('CAIFSharedBundle:Student');
        $query      = $repository->createQueryBuilder('s')
                        ->select('s')
                        ->where('s.email = :username')
                        ->orWhere('s.username = :username')
                        ->setParameter('username', $username)
                        ->getQuery();

        try {
            // The Query::getSingleResult() method throws an exception
            // if there is no record matching the criteria.
            $user = $query->getSingleResult();
        } catch (NoResultException $e) {
            $message = sprintf(
                'Unable to find an active CAIFSharedBundle:Student object identified by "%s".',
                $username
            );
            throw new UsernameNotFoundException($message, 0, $e);
        }

        return $user;
    }

    public function refreshUser(UserInterface $user)
    {
        $class = get_class($user);
        if (! $this->supportsClass($class)) {
            throw new UnsupportedUserException(
                sprintf(
                    'Instances of "%s" are not supported.',
                    $class
                )
            );
        }

        $personId = $this->em->getClassMetadata('CAIFSharedBundle:Student')->getIdentifierValues($user);

        $repository = $this->em->getRepository('CAIFSharedBundle:Student');
        $user       = $repository->find($personId);

        return $user;
    }

    public function supportsClass($class)
    {
        $classes = [
            'Proxies\__CG__\CAIF\SharedBundle\Entity\Student',
            'CAIF\SharedBundle\Entity\Student',
        ];
        return in_array($class, $classes);
    }
}
