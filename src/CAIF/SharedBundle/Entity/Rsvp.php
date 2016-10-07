<?php

namespace CAIF\SharedBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use CAIF\SharedBundle\Traits\TimestampableTrait;

/**
 * @ORM\Entity()
 * @ORM\Table(name="rsvp")
 */
class Rsvp
{
    use TimestampableTrait;

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="rsvps")
     * @ORM\JoinColumn(name="person_id", referencedColumnName="id", nullable=true)
     */
    protected $person;

    /**
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(name="rsvp_option", type="string", length=255)
     */
    private $rsvpOption;

    /**
     * @ORM\Column(name="guests", type="integer", nullable=true)
     */
    private $guests;

    /**
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="rsvps")
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     */
    protected $event;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set person
     *
     * @param string $person
     * @return Rsvp
     */
    public function setPerson(\CAIF\SharedBundle\Entity\Person $person)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return string
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Rsvp
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
     * @return Rsvp
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
     * Set rsvpOption
     *
     * @param string $rsvpOption
     * @return Rsvp
     */
    public function setRsvpOption($rsvpOption)
    {
        $this->rsvpOption = $rsvpOption;

        return $this;
    }

    /**
     * Get rsvpOption
     *
     * @return string
     */
    public function getRsvpOption()
    {
        return $this->rsvpOption;
    }

    /**
     * Set guests
     *
     * @param integer $guests
     * @return Rsvp
     */
    public function setGuests($guests)
    {
        $this->guests = $guests;

        return $this;
    }

    /**
     * Get guests
     *
     * @return integer
     */
    public function getGuests()
    {
        return $this->guests;
    }

    /**
     * Set event
     *
     * @param string $event
     * @return Rsvp
     */
    public function setEvent(\CAIF\SharedBundle\Entity\Event $event)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return string
     */
    public function getEvent()
    {
        return $this->event;
    }
}
