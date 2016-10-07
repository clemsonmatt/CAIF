<?php

namespace CAIF\SharedBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use CAIF\SharedBundle\Entity\Event;
use CAIF\SharedBundle\Traits\TimestampableTrait;

/**
 * @ORM\Entity()
 * @ORM\Table(name="email")
 */
class Email
{
    use TimestampableTrait;

    public static function toList(Event $event = null)
    {
        if ($event !== null) {
            return [
                'Event '.$event->getId().' RSVP List' => $event->getTitle().' RSVP List',
            ];
        }

        return [
            'All'                                     => 'All',
            'All Students'                            => 'All Students',
            'Students with host'                      => 'Students with host',
            'Students without hosts'                  => 'Students without hosts',
            'Students with host not needed'           => 'Students with host not needed',
            'All Community Members'                   => 'All Community Members',
            'Only Community Members that host'        => 'Only Community Members that host',
            'Only Community Members that do not host' => 'Only Community Members that do not host',
        ];
    }

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="sent_to", type="string", length=255)
     */
    private $to;

    /**
     * @ORM\Column(name="subject", type="string", length=255)
     */
    private $subject;

    /**
     * @ORM\Column(name="message", type="text")
     */
    private $message;


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
     * Set to
     *
     * @param string $to
     * @return Email
     */
    public function setTo($to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * Get to
     *
     * @return string
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * Set subject
     *
     * @param string $subject
     * @return Email
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return Email
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
