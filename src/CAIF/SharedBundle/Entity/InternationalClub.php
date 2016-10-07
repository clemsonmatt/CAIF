<?php

namespace CAIF\SharedBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use CAIF\SharedBundle\Traits\TimestampableTrait;

/**
 * @ORM\Entity()
 * @ORM\Table(name="international_club")
 */
class InternationalClub
{
    use TimestampableTrait;

    public function __toString()
    {
        return $this->title;
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
     * @ORM\Column(name="info", type="text")
     */
    private $info;

    /**
     * @ORM\Column(name="what_day", type="string", length=255)
     */
    private $whatDay;

    /**
     * @ORM\Column(name="location", type="string", length=255)
     */
    private $location;

    /**
     * @ORM\Column(name="start_time", type="time")
     */
    private $startTime;

    /**
     * @ORM\Column(name="end_time", type="time")
     */
    private $endTime;

    /**
     * @ORM\Column(name="food", type="text", nullable=true)
     */
    private $food;

    /**
     * @ORM\Column(name="childcare", type="text", nullable=true)
     */
    private $childcare;

    /**
     * @ORM\Column(name="comments", type="text", nullable=true)
     */
    private $comments;

    /**
     * @ORM\Column(name="contact_name", type="string", length=255)
     */
    private $contactName;

    /**
     * @ORM\Column(name="contact_phone", type="string", length=255)
     */
    private $contactPhone;

    /**
     * @ORM\Column(name="contact_email", type="string", length=255)
     */
    private $contactEmail;


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
     * @return InternationalClub
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
     * Set info
     *
     * @param string $info
     * @return InternationalClub
     */
    public function setInfo($info)
    {
        $this->info = $info;

        return $this;
    }

    /**
     * Get info
     *
     * @return string
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * Set whatDay
     *
     * @param string $whatDay
     * @return InternationalClub
     */
    public function setWhatDay($whatDay)
    {
        $this->whatDay = $whatDay;

        return $this;
    }

    /**
     * Get whatDay
     *
     * @return string
     */
    public function getWhatDay()
    {
        return $this->whatDay;
    }

    /**
     * Set location
     *
     * @param string $location
     * @return InternationalClub
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
     * Set startTime
     *
     * @param string $startTime
     * @return InternationalClub
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
     * @return InternationalClub
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
     * Set food
     *
     * @param string $food
     * @return InternationalClub
     */
    public function setFood($food)
    {
        $this->food = $food;

        return $this;
    }

    /**
     * Get food
     *
     * @return string
     */
    public function getFood()
    {
        return $this->food;
    }

    /**
     * Set childcare
     *
     * @param string $childcare
     * @return InternationalClub
     */
    public function setChildcare($childcare)
    {
        $this->childcare = $childcare;

        return $this;
    }

    /**
     * Get childcare
     *
     * @return string
     */
    public function getChildcare()
    {
        return $this->childcare;
    }

    /**
     * Set comments
     *
     * @param string $comments
     * @return InternationalClub
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get comments
     *
     * @return string
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set contactName
     *
     * @param string $contactName
     * @return InternationalClub
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
     * @return InternationalClub
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
     * @return InternationalClub
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
}
