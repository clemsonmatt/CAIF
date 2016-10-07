<?php

namespace CAIF\SharedBundle\Form\Model;

use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;
use Symfony\Component\Validator\Constraints as Assert;

class ChangePassword
{
    /**
     * @SecurityAssert\UserPassword(
     *     message = "Wrong value for your current password"
     * )
     */
     public $oldPassword;

    /**
     * @Assert\Length(
     *     min = 8,
     *     minMessage = "Password should be at least 8 chars long",
     *     max = 255,
     *     maxMessage = "Password should be no more than 255 chars long"
     * )
     */
     public $newPassword;
}
