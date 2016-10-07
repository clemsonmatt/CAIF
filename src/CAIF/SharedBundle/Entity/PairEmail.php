<?php

namespace CAIF\SharedBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use CAIF\SharedBundle\Entity\Host;
use CAIF\SharedBundle\Entity\Student;
use CAIF\SharedBundle\Traits\TimestampableTrait;

/**
 * @ORM\Entity()
 * @ORM\Table(name="pair_email")
 */
class PairEmail
{
    use TimestampableTrait;

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="sent", type="boolean")
     */
    private $sent = false;

    /**
     * @ORM\ManyToOne(targetEntity="Host")
     * @ORM\JoinColumn(name="host_id", referencedColumnName="id")
     */
    private $host;

    /**
     * @ORM\Column(name="students", type="array")
     */
     private $students;


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
     * Set sent
     *
     * @param boolean $sent
     * @return PairEmail
     */
    public function setSent($sent)
    {
        $this->sent = $sent;

        return $this;
    }

    /**
     * Get sent
     *
     * @return boolean
     */
    public function isSent()
    {
        return $this->sent;
    }

    /**
     * Set host
     *
     * @param Host $host
     * @return PairEmail
     */
    public function setHost(Host $host)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * Get host
     *
     * @return Host
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Set students
     *
     * @param Array $students
     * @return PairEmail
     */
    public function setStudents($students)
    {
        $this->students = $students;

        return $this;
    }

    /**
     * Get students
     *
     * @return Array
     */
    public function getStudents()
    {
        return $this->students;
    }
}
