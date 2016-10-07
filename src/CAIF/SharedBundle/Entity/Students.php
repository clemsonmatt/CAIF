<?php

namespace CAIF\SharedBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use CAIF\SharedBundle\Traits\TimestampableTrait;

/**
 * @ORM\Entity()
 * @ORM\Table(name="caifclemson_download.students")
 */
class Students
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="host_id", type="integer")
     */
    private $hostId;

    /**
     * @ORM\Column(name="first_name", type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(name="last_name", type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(name="american_name", type="string", length=255, nullable=true)
     */
    private $americanName;

    /**
     * @ORM\Column(name="gender", type="string", length=255)
     */
    private $gender;

    /**
     * @ORM\Column(name="birthday", type="string", length=255)
     */
    private $birthday;

    /**
     * @ORM\Column(name="phone", type="string", length=255)
     */
    private $phone;

    /**
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(name="apartment_complex", type="string", length=255, nullable=true)
     */
    private $apartmentComplex;

    /**
     * @ORM\Column(name="apartment_number", type="string", length=255, nullable=true)
     */
    private $apartmentNumber;

    /**
     * @ORM\Column(name="mailing_address", type="string", length=255)
     */
    private $mailingAddress;

    /**
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(name="zip", type="string", length=255)
     */
    private $zip;

    /**
     * @ORM\Column(name="area_of_study", type="string", length=255)
     */
    private $areaOfStudy;

    /**
     * @ORM\Column(name="degree_program", type="string", length=255)
     */
    private $degreeProgram;

    /**
     * @ORM\Column(name="home_country", type="string", length=255)
     */
    private $homeCountry;

    /**
     * @ORM\Column(name="allergies", type="text", nullable=true)
     */
    private $allergies;

    /**
     * @ORM\Column(name="languages", type="text", nullable=true)
     */
    private $languages;

    /**
     * @ORM\Column(name="travel", type="text", nullable=true)
     */
    private $travel;

    /**
     * @ORM\Column(name="activities", type="text", nullable=true)
     */
    private $activities;

    /**
     * @ORM\Column(name="DNE_foods", type="text", nullable=true)
     */
    private $dneFoods;

    /**
     * @ORM\Column(name="marital_status", type="string", length=255)
     */
    private $maritalStatus;

    /**
     * @ORM\Column(name="spouse_here", type="boolean", nullable=true)
     */
    private $spouseHere;

    /**
     * @ORM\Column(name="spouse_name", type="string", length=255, nullable=true)
     */
    private $spouseName;

    /**
     * @ORM\Column(name="kids", type="string", length=255)
     */
    private $kids;

    /**
     * @ORM\Column(name="kids_here", type="boolean", nullable=true)
     */
    private $kidsHere;

    /**
     * @ORM\Column(name="smoke", type="boolean", nullable=true)
     */
    private $smoke;

    /**
     * @ORM\Column(name="car", type="boolean", nullable=true)
     */
    private $car;

    /**
     * @ORM\Column(name="pic", type="text", nullable=true)
     */
    private $photo;

    /**
     * @ORM\Column(name="username", type="string", length=255)
     */
    protected $username;

    /**
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @ORM\Column(name="submit_time", type="integer", nullable=true)
     */
    private $submitTime;


    /**
     * Set username
     *
     * @param string $username
     * @return Person
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set active
     *
     * @param string $active
     * @return Person
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return string
     */
    public function isActive()
    {
        return $this->active;
    }


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
     * Set hostId
     *
     * @param string $hostId
     * @return Students
     */
    public function setHostId($hostId)
    {
        $this->hostId = $hostId;

        return $this;
    }

    /**
     * Get hostId
     *
     * @return string
     */
    public function getHostId()
    {
        return $this->hostId;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return Student
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return Student
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set americanName
     *
     * @param string $americanName
     * @return Student
     */
    public function setAmericanName($americanName)
    {
        $this->americanName = $americanName;

        return $this;
    }

    /**
     * Get americanName
     *
     * @return string
     */
    public function getAmericanName()
    {
        return $this->americanName;
    }

    /**
     * Set gender
     *
     * @param string $gender
     * @return Student
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set birthday
     *
     * @param string $birthday
     * @return Student
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return string
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Student
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Student
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
     * Set apartmentComplex
     *
     * @param string $apartmentComplex
     * @return Student
     */
    public function setApartmentComplex($apartmentComplex)
    {
        $this->apartmentComplex = $apartmentComplex;

        return $this;
    }

    /**
     * Get apartmentComplex
     *
     * @return string
     */
    public function getApartmentComplex()
    {
        return $this->apartmentComplex;
    }

    /**
     * Set apartmentNumber
     *
     * @param string $apartmentNumber
     * @return Student
     */
    public function setApartmentNumber($apartmentNumber)
    {
        $this->apartmentNumber = $apartmentNumber;

        return $this;
    }

    /**
     * Get apartmentNumber
     *
     * @return string
     */
    public function getApartmentNumber()
    {
        return $this->apartmentNumber;
    }

    /**
     * Set mailingAddress
     *
     * @param string $mailingAddress
     * @return Student
     */
    public function setMailingAddress($mailingAddress)
    {
        $this->mailingAddress = $mailingAddress;

        return $this;
    }

    /**
     * Get mailingAddress
     *
     * @return string
     */
    public function getMailingAddress()
    {
        return $this->mailingAddress;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Student
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set zip
     *
     * @param string $zip
     * @return Student
     */
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * Get zip
     *
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Set areaOfStudy
     *
     * @param string $areaOfStudy
     * @return Student
     */
    public function setAreaOfStudy($areaOfStudy)
    {
        $this->areaOfStudy = $areaOfStudy;

        return $this;
    }

    /**
     * Get areaOfStudy
     *
     * @return string
     */
    public function getAreaOfStudy()
    {
        return $this->areaOfStudy;
    }

    /**
     * Set degreeProgram
     *
     * @param string $degreeProgram
     * @return Student
     */
    public function setDegreeProgram($degreeProgram)
    {
        $this->degreeProgram = $degreeProgram;

        return $this;
    }

    /**
     * Get degreeProgram
     *
     * @return string
     */
    public function getDegreeProgram()
    {
        return $this->degreeProgram;
    }

    /**
     * Set homeCountry
     *
     * @param string $homeCountry
     * @return Student
     */
    public function setHomeCountry($homeCountry)
    {
        $this->homeCountry = $homeCountry;

        return $this;
    }

    /**
     * Get homeCountry
     *
     * @return string
     */
    public function getHomeCountry()
    {
        return $this->homeCountry;
    }

    /**
     * Set allergies
     *
     * @param string $allergies
     * @return Student
     */
    public function setAllergies($allergies)
    {
        $this->allergies = $allergies;

        return $this;
    }

    /**
     * Get allergies
     *
     * @return string
     */
    public function getAllergies()
    {
        return $this->allergies;
    }

    /**
     * Set languages
     *
     * @param string $languages
     * @return Student
     */
    public function setLanguages($languages)
    {
        $this->languages = $languages;

        return $this;
    }

    /**
     * Get languages
     *
     * @return string
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * Set travel
     *
     * @param string $travel
     * @return Student
     */
    public function setTravel($travel)
    {
        $this->travel = $travel;

        return $this;
    }

    /**
     * Get travel
     *
     * @return string
     */
    public function getTravel()
    {
        return $this->travel;
    }

    /**
     * Set activities
     *
     * @param string $activities
     * @return Student
     */
    public function setActivities($activities)
    {
        $this->activities = $activities;

        return $this;
    }

    /**
     * Get activities
     *
     * @return string
     */
    public function getActivities()
    {
        return $this->activities;
    }

    /**
     * Set dneFoods
     *
     * @param string $dneFoods
     * @return Student
     */
    public function setDneFoods($dneFoods)
    {
        $this->dneFoods = $dneFoods;

        return $this;
    }

    /**
     * Get dneFoods
     *
     * @return string
     */
    public function getDneFoods()
    {
        return $this->dneFoods;
    }

    /**
     * Set maritalStatus
     *
     * @param string $maritalStatus
     * @return Student
     */
    public function setMaritalStatus($maritalStatus)
    {
        $this->maritalStatus = $maritalStatus;

        return $this;
    }

    /**
     * Get maritalStatus
     *
     * @return string
     */
    public function getMaritalStatus()
    {
        return $this->maritalStatus;
    }

    /**
     * Set spouseHere
     *
     * @param string $spouseHere
     * @return Student
     */
    public function setSpouseHere($spouseHere)
    {
        $this->spouseHere = $spouseHere;

        return $this;
    }

    /**
     * Get spouseHere
     *
     * @return string
     */
    public function getSpouseHere()
    {
        return $this->spouseHere;
    }

    /**
     * Set spouseName
     *
     * @param string $spouseName
     * @return Student
     */
    public function setSpouseName($spouseName)
    {
        $this->spouseName = $spouseName;

        return $this;
    }

    /**
     * Get spouseName
     *
     * @return string
     */
    public function getSpouseName()
    {
        return $this->spouseName;
    }

    /**
     * Set kids
     *
     * @param string $kids
     * @return Students
     */
    public function setKids($kids)
    {
        $this->kids = $kids;

        return $this;
    }

    /**
     * Get kids
     *
     * @return string
     */
    public function getKids()
    {
        return $this->kids;
    }

    /**
     * Set kidsHere
     *
     * @param string $kidsHere
     * @return Student
     */
    public function setKidsHere($kidsHere)
    {
        $this->kidsHere = $kidsHere;

        return $this;
    }

    /**
     * Get kidsHere
     *
     * @return string
     */
    public function getKidsHere()
    {
        return $this->kidsHere;
    }

    /**
     * Set kidsName
     *
     * @param string $kidsName
     * @return Student
     */
    public function setKidsName($kidsName)
    {
        $this->kidsName = $kidsName;

        return $this;
    }

    /**
     * Get kidsName
     *
     * @return string
     */
    public function getKidsName()
    {
        return $this->kidsName;
    }

    /**
     * Set smoke
     *
     * @param string $smoke
     * @return Student
     */
    public function setSmoke($smoke)
    {
        $this->smoke = $smoke;

        return $this;
    }

    /**
     * Get smoke
     *
     * @return string
     */
    public function getSmoke()
    {
        return $this->smoke;
    }

    /**
     * Set car
     *
     * @param string $car
     * @return Student
     */
    public function setCar($car)
    {
        $this->car = $car;

        return $this;
    }

    /**
     * Get car
     *
     * @return string
     */
    public function getCar()
    {
        return $this->car;
    }

    /**
     * Set photo
     *
     * @param string $photo
     * @return Student
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set submitTime
     *
     * @param string $submitTime
     * @return Students
     */
    public function setSubmitTime($submitTime)
    {
        $this->submitTime = $submitTime;

        return $this;
    }

    /**
     * Get submitTime
     *
     * @return string
     */
    public function getSubmitTime()
    {
        return $this->submitTime;
    }
}
