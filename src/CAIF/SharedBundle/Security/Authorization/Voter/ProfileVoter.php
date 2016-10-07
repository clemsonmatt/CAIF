<?php

namespace CAIF\SharedBundle\Security\Authorization\Voter;

use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\User\UserInterface;

use CAIF\SharedBundle\Entity\Person;

/**
 * @DI\Service("caif.shared.security.voter.profile_voter", public=false)
 * @DI\Tag("security.voter")
 */
class ProfileVoter implements VoterInterface
{
    const VIEW = 'caif-profile';

    public function supportsAttribute($attribute)
    {
        return in_array($attribute, [
            self::VIEW,
        ]);
    }

    public function supportsClass($class)
    {
        $supportedClass = 'CAIF\SharedBundle\Entity\Person';

        return $supportedClass === $class || is_subclass_of($class, $supportedClass);
    }

    private function internalVote(TokenInterface $token, Person $person, array $attributes)
    {
        if (! $this->supportsClass(get_class($person))) {
            return VoterInterface::ACCESS_ABSTAIN;
        }

        // check if the voter is used correct, only allow one attribute
        // this isn't a requirement, it's just one easy way for you to
        // design your voter
        if (1 !== count($attributes)) {
            throw new \InvalidArgumentException(
                'Only one attribute is allowed for EDIT'
            );
        }

        // set the attribute to check against
        $attribute = $attributes[0];

        // check if the given attribute is covered by this voter
        if (!$this->supportsAttribute($attribute)) {
            return VoterInterface::ACCESS_ABSTAIN;
        }

        // get current logged in user
        $user = $token->getUser();

        // make sure there is a user object (i.e. that the user is logged in)
        if (! $user instanceof UserInterface) {
            return VoterInterface::ACCESS_DENIED;
        }

        switch($attribute) {
            case self::VIEW:
                /* check for same user */
                if ($person == $user) {
                    return VoterInterface::ACCESS_GRANTED;
                }

                /* check for admin */
                $tokenRoles = $token->getRoles();
                $neededRole = 'ROLE_ADMIN';

                foreach ($tokenRoles as $role) {
                    if ($role->getRole() == $neededRole) {
                        return VoterInterface::ACCESS_GRANTED;
                    }
                }
        }

        return VoterInterface::ACCESS_DENIED;
    }

    /**
     *
     */
    public function vote(TokenInterface $token, $object, array $attributes)
    {
        if (! $object instanceof Person) {
            return VoterInterface::ACCESS_ABSTAIN;
        }

        return $this->internalVote($token, $object, $attributes);
    }
}
