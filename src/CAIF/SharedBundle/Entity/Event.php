<?php

namespace CAIF\SharedBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

use CAIF\SharedBundle\Traits\TimestampableTrait;

/**
 * @ORM\Entity()
 * @ORM\Table(name="event")
 */
class Event
{
    use TimestampableTrait;

    public function __toString()
    {
        return $this->title;
    }

    /**
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context)
    {
        $this->startTime = date('H:i:s', strtotime($this->startTime));
        $this->endTime   = date('H:i:s', strtotime($this->endTime));
    }


    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @ORM\Column(name="location", type="string", length=255)
     */
    private $location;

    /**
     * @ORM\Column(name="start_date", type="date")
     */
    private $startDate;

    /**
     * @ORM\Column(name="end_date", type="date", nullable=true)
     */
    private $endDate;

    /**
     * @ORM\Column(name="start_time", type="string", nullable=true)
     */
    private $startTime;

    /**
     * @ORM\Column(name="end_time", type="string", nullable=true)
     */
    private $endTime;

    /**
     * @ORM\Column(name="rsvp", type="boolean")
     */
    private $rsvp;

    /**
     * @ORM\Column(name="recurring", type="boolean")
     */
    private $recurring;

    /**
     * @ORM\Column(name="contact_name", type="string", nullable=true)
     */
    private $contactName;

    /**
     * @ORM\Column(name="contact_phone", type="string", nullable=true)
     */
    private $contactPhone;

    /**
     * @ORM\Column(name="contact_email", type="string", nullable=true)
     */
    private $contactEmail;

    /**
     * @ORM\OneToMany(targetEntity="Rsvp", mappedBy="event")
     */
    private $rsvps;


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
     * Set title
     *
     * @param string $title
     * @return Event
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Event
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set location
     *
     * @param string $location
     * @return Event
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set startDate
     *
     * @param string $startDate
     * @return Event
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return string
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param string $endDate
     * @return Event
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return string
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set startTime
     *
     * @param string $startTime
     * @return Event
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Get startTime
     *
     * @return string
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set endTime
     *
     * @param string $endTime
     * @return Event
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * Get endTime
     *
     * @return string
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * Set rsvp
     *
     * @param string $rsvp
     * @return Event
     */
    public function setRsvp($rsvp)
    {
        $this->rsvp = $rsvp;

        return $this;
    }

    /**
     * Is rsvp
     *
     * @return string
     */
    public function isRsvp()
    {
        return $this->rsvp;
    }

    /**
     * Set recurring
     *
     * @param string $recurring
     * @return Event
     */
    public function setRecurring($recurring)
    {
        $this->recurring = $recurring;

        return $this;
    }

    /**
     * Get recurring
     *
     * @return string
     */
    public function getRecurring()
    {
        return $this->recurring;
    }

    /**
     * Set contactName
     *
     * @param string $contactName
     * @return Event
     */
    public function setContactName($contactName)
    {
        $this->contactName = $contactName;

        return $this;
    }

    /**
     * Get contactName
     *
     * @return string
     */
    public function getContactName()
    {
        return $this->contactName;
    }

    /**
     * Set contactPhone
     *
     * @param string $contactPhone
     * @return Event
     */
    public function setContactPhone($contactPhone)
    {
        $this->contactPhone = $contactPhone;

        return $this;
    }

    /**
     * Get contactPhone
     *
     * @return string
     */
    public function getContactPhone()
    {
        return $this->contactPhone;
    }

    /**
     * Set contactEmail
     *
     * @param string $contactEmail
     * @return Event
     */
    public function setContactEmail($contactEmail)
    {
        $this->contactEmail = $contactEmail;

        return $this;
    }

    /**
     * Get contactEmail
     *
     * @return string
     */
    public function getContactEmail()
    {
        return $this->contactEmail;
    }

    /**
     * Set rsvps
     *
     * @param string $rsvps
     * @return Event
     */
    public function setRsvps($rsvps)
    {
        $this->rsvps = $rsvps;

        return $this;
    }

    /**
     * Get rsvps
     *
     * @return string
     */
    public function getRsvps()
    {
        return $this->rsvps;
    }
}
