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
 * @DI\Service("caif_shared.admin_user_provider")
 */
class AdminUserProvider implements UserProviderInterface
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
        $repository = $this->em->getRepository('CAIFSharedBundle:Admin');
        $query      = $repository->createQueryBuilder('a')
                        ->select('a')
                        ->where('a.email = :username')
                        ->orWhere('a.username = :username')
                        ->setParameter('username', $username)
                        ->getQuery();

        try {
            // The Query::getSingleResult() method throws an exception
            // if there is no record matching the criteria.
            $user = $query->getSingleResult();
        } catch (NoResultException $e) {
            $message = sprintf(
                'Unable to find an active CAIFSharedBundle:Admin object identified by "%s".',
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

        $personId = $this->em->getClassMetadata('CAIFSharedBundle:Admin')->getIdentifierValues($user);

        $repository = $this->em->getRepository('CAIFSharedBundle:Admin');
        $user       = $repository->find($personId);

        return $user;
    }

    public function supportsClass($class)
    {
        $classes = [
            'Proxies\__CG__\CAIF\SharedBundle\Entity\Admin',
            'CAIF\SharedBundle\Entity\Admin',
        ];
        return in_array($class, $classes);
    }
}
