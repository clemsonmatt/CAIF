<?php

namespace CAIF\SharedBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use CAIF\SharedBundle\Traits\TimestampableTrait;

/**
 * @ORM\Entity()
 * @ORM\Table(name="message")
 */
class Message
{
    use TimestampableTrait;

    public static function getAllAffiliations()
    {
        return [
            'Enrolled Student'      => 'Enrolled Student',
            'Prospective Student'   => 'Prospective Student',
            'Faculty/Staff'         => 'Faculty/Staff',
            'CAIF Community Member' => 'CAIF Community Member',
            'Other'                 => 'Other',
        ];
    }

    public static function getAllPertainsTo()
    {
        return [
            'Host Friend Program'     => 'Host Friend Program',
            'Housing'                 => 'Housing',
            'Transportation'          => 'Transportation',
            'Funiture/Household Item' => 'Funiture/Household Item',
            'CAIF Upcoming Event'     => 'CAIF Upcoming Event',
            'Donation'                => 'Donation',
            'Other'                   => 'Other',
        ];
    }

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="user_id", type="integer", nullable=true)
     */
    private $userId;

    /**
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(name="affiliation", type="string", length=255)
     */
    private $affiliation;

    /**
     * @ORM\Column(name="pertains", type="string", length=255)
     */
    private $pertains;

    /**
     * @ORM\Column(name="message", type="text")
     */
    private $message;


    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set userId
     *
     * @param string $userId
     * @return Message
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Message
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Message
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set affiliation
     *
     * @param string $affiliation
     * @return Message
     */
    public function setAffiliation($affiliation)
    {
        $this->affiliation = $affiliation;

        return $this;
    }

    /**
     * Get affiliation
     *
     * @return string
     */
    public function getAffiliation()
    {
        return $this->affiliation;
    }

    /**
     * Set pertains
     *
     * @param string $pertains
     * @return Message
     */
    public function setPertains($pertains)
    {
        $this->pertains = $pertains;

        return $this;
    }

    /**
     * Get pertains
     *
     * @return string
     */
    public function getPertains()
    {
        return $this->pertains;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return Message
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
}
