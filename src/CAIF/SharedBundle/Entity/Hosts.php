<?php

namespace CAIF\SharedBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="caifclemson_download.hosts")
 */
class Hosts
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(name="state", type="string", length=255)
     */
    private $state;

    /**
     * @ORM\Column(name="zip", type="integer")
     */
    private $zip;

    /**
     * @ORM\Column(name="mobile_phone", type="string", length=255, nullable=true)
     */
    private $mobilePhone;

    /**
     * @ORM\Column(name="home_phone", type="string", length=255, nullable=true)
     */
    private $homePhone;

    /**
     * @ORM\Column(name="work_phone", type="string", length=255, nullable=true)
     */
    private $workPhone;

    /**
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(name="pic", type="string", length=255)
     */
    private $photo;

    /**
     * @ORM\Column(name="sm_child", type="boolean")
     */
    private $smChild;

    /**
     * @ORM\Column(name="tn_child", type="boolean")
     */
    private $tnChild;

    /**
     * @ORM\Column(name="cl_child", type="boolean")
     */
    private $clChild;

    /**
     * @ORM\Column(name="gr_child", type="boolean")
     */
    private $grChild;

    /**
     * @ORM\Column(name="no_child", type="boolean")
     */
    private $noChild;

    /**
     * @ORM\Column(name="pet", type="string", length=255)
     *
     * - options: no, outside, inside, both inside and outside
     */
    private $pet;

    /**
     * @ORM\Column(name="pet_type", type="string", length=255)
     */
    private $petType;

    /**
     * @ORM\Column(name="hobbies", type="text", nullable=true)
     */
    private $hobbies;

    /**
     * @ORM\Column(name="travel", type="text", nullable=true)
     */
    private $travel;

    /**
     * @ORM\Column(name="languages", type="text", nullable=true)
     */
    private $languages;

    /**
     * @ORM\Column(name="type_stu", type="integer")
     */
    private $studentType;

    /**
     * @ORM\Column(name="country", type="string", length=255)
     */
    private $studentCountry;

    /**
     * @ORM\Column(name="students", type="string")
     */
    private $maxStudents;

    /**
     * @ORM\Column(name="host_option", type="boolean")
     */
    private $hosting;

    /**
     * @ORM\Column(name="ilep", type="boolean")
     */
    private $ilep;

    /**
     * @ORM\Column(name="financial", type="boolean")
     */
    private $financial;

    /**
     * @ORM\Column(name="contribution", type="integer", nullable=true)
     */
    private $financialContribution;

    /**
     * @ORM\Column(name="ladies", type="boolean")
     */
    private $wivesClub;

    /**
     * @ORM\Column(name="event_help", type="boolean")
     */
    private $eventHelp;

    /**
     * @ORM\Column(name="festival", type="boolean")
     */
    private $festival;

    /**
     * @ORM\Column(name="bake_dessert", type="boolean")
     */
    private $bakeDessert;

    /**
     * @ORM\Column(name="man_booth", type="boolean")
     */
    private $manBooth;

    /**
     * @ORM\Column(name="english_class", type="boolean")
     */
    private $englishClass;

    /**
     * @ORM\Column(name="fall_english_class", type="boolean")
     */
    private $fallEnglishClass;

    /**
     * @ORM\Column(name="spring_english_class", type="boolean")
     */
    private $springEnglishClass;

    /**
     * @ORM\Column(name="summer_english_class", type="boolean")
     */
    private $summerEnglishClass;

    /**
     * @ORM\Column(name="shopping_trips", type="boolean")
     */
    private $shopping;

    /**
     * @ORM\Column(name="group_outing", type="boolean")
     */
    private $groupOuting;

    /**
     * @ORM\Column(name="provide_meal", type="boolean")
     */
    private $provideMeal;

    /**
     * @ORM\Column(name="recruitment", type="boolean")
     */
    private $recruitment;

    /**
     * @ORM\Column(name="reference_name", type="string", length=255)
     */
    private $referenceName;

    /**
     * @ORM\Column(name="reference_phone", type="string", length=255)
     */
    private $referencePhone;

    /**
     * @ORM\Column(name="reference_email", type="string", length=255)
     */
    private $referenceEmail;

    /**
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @ORM\Column(name="submit_time", type="string", length=255)
     */
    private $submitTime;


    /**
     * Set id
     *
     * @param string $id
     * @return Hosts
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * Set username
     *
     * @param string $username
     * @return Hosts
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
     * Set name
     *
     * @param string $name
     * @return Hosts
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
     * Set address
     *
     * @param string $address
     * @return Hosts
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Hosts
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
     * Set state
     *
     * @param string $state
     * @return Hosts
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set zip
     *
     * @param string $zip
     * @return Hosts
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
     * Set mobilePhone
     *
     * @param string $mobilePhone
     * @return Hosts
     */
    public function setMobilePhone($mobilePhone)
    {
        $this->mobilePhone = $mobilePhone;

        return $this;
    }

    /**
     * Get mobilePhone
     *
     * @return string
     */
    public function getMobilePhone()
    {
        return $this->mobilePhone;
    }

    /**
     * Set homePhone
     *
     * @param string $homePhone
     * @return Hosts
     */
    public function setHomePhone($homePhone)
    {
        $this->homePhone = $homePhone;

        return $this;
    }

    /**
     * Get homePhone
     *
     * @return string
     */
    public function getHomePhone()
    {
        return $this->homePhone;
    }

    /**
     * Set workPhone
     *
     * @param string $workPhone
     * @return Hosts
     */
    public function setWorkPhone($workPhone)
    {
        $this->workPhone = $workPhone;

        return $this;
    }

    /**
     * Get workPhone
     *
     * @return string
     */
    public function getWorkPhone()
    {
        return $this->workPhone;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Hosts
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
     * Set photo
     *
     * @param string $photo
     * @return Hosts
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
     * Set smChild
     *
     * @param string $smChild
     * @return Hosts
     */
    public function setSmChild($smChild)
    {
        $this->smChild = $smChild;

        return $this;
    }

    /**
     * Get smChild
     *
     * @return string
     */
    public function getSmChild()
    {
        return $this->smChild;
    }

    /**
     * Set tnChild
     *
     * @param string $tnChild
     * @return Hosts
     */
    public function setTnChild($tnChild)
    {
        $this->tnChild = $tnChild;

        return $this;
    }

    /**
     * Get tnChild
     *
     * @return string
     */
    public function getTnChild()
    {
        return $this->tnChild;
    }

    /**
     * Set clChild
     *
     * @param string $clChild
     * @return Hosts
     */
    public function setClChild($clChild)
    {
        $this->clChild = $clChild;

        return $this;
    }

    /**
     * Get clChild
     *
     * @return string
     */
    public function getClChild()
    {
        return $this->clChild;
    }

    /**
     * Set grChild
     *
     * @param string $grChild
     * @return Hosts
     */
    public function setGrChild($grChild)
    {
        $this->grChild = $grChild;

        return $this;
    }

    /**
     * Get grChild
     *
     * @return string
     */
    public function getGrChild()
    {
        return $this->grChild;
    }

    /**
     * Set noChild
     *
     * @param string $noChild
     * @return Hosts
     */
    public function setNoChild($noChild)
    {
        $this->noChild = $noChild;

        return $this;
    }

    /**
     * Get noChild
     *
     * @return string
     */
    public function getNoChild()
    {
        return $this->noChild;
    }

    /**
     * Set pet
     *
     * @param string $pet
     * @return Hosts
     */
    public function setPet($pet)
    {
        $this->pet = $pet;

        return $this;
    }

    /**
     * Get pet
     *
     * @return string
     */
    public function getPet()
    {
        return $this->pet;
    }

    /**
     * Set petType
     *
     * @param string $petType
     * @return Hosts
     */
    public function setPetType($petType)
    {
        $this->petType = $petType;

        return $this;
    }

    /**
     * Get petType
     *
     * @return string
     */
    public function getPetType()
    {
        return $this->petType;
    }

    /**
     * Set hobbies
     *
     * @param string $hobbies
     * @return Hosts
     */
    public function setHobbies($hobbies)
    {
        $this->hobbies = $hobbies;

        return $this;
    }

    /**
     * Get hobbies
     *
     * @return string
     */
    public function getHobbies()
    {
        return $this->hobbies;
    }

    /**
     * Set travel
     *
     * @param string $travel
     * @return Hosts
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
     * Set languages
     *
     * @param string $languages
     * @return Hosts
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
     * Set studentType
     *
     * @param string $studentType
     * @return Hosts
     */
    public function setStudentType($studentType)
    {
        $this->studentType = $studentType;

        return $this;
    }

    /**
     * Get studentType
     *
     * @return string
     */
    public function getStudentType()
    {
        return $this->studentType;
    }

    /**
     * Set studentCountry
     *
     * @param string $studentCountry
     * @return Hosts
     */
    public function setStudentCountry($studentCountry)
    {
        $this->studentCountry = $studentCountry;

        return $this;
    }

    /**
     * Get studentCountry
     *
     * @return string
     */
    public function getStudentCountry()
    {
        return $this->studentCountry;
    }

    /**
     * Set maxStudents
     *
     * @param string $maxStudents
     * @return Hosts
     */
    public function setMaxStudents($maxStudents)
    {
        $this->maxStudents = $maxStudents;

        return $this;
    }

    /**
     * Get maxStudents
     *
     * @return string
     */
    public function getMaxStudents()
    {
        return $this->maxStudents;
    }

    /**
     * Set hosting
     *
     * @param string $hosting
     * @return Hosts
     */
    public function setHosting($hosting)
    {
        $this->hosting = $hosting;

        return $this;
    }

    /**
     * Get hosting
     *
     * @return string
     */
    public function getHosting()
    {
        return $this->hosting;
    }

    /**
     * Set ilep
     *
     * @param string $ilep
     * @return Hosts
     */
    public function setIlep($ilep)
    {
        $this->ilep = $ilep;

        return $this;
    }

    /**
     * Get ilep
     *
     * @return string
     */
    public function getIlep()
    {
        return $this->ilep;
    }

    /**
     * Set financial
     *
     * @param string $financial
     * @return Hosts
     */
    public function setFinancial($financial)
    {
        $this->financial = $financial;

        return $this;
    }

    /**
     * Get financial
     *
     * @return string
     */
    public function getFinancial()
    {
        return $this->financial;
    }

    /**
     * Set financialContribution
     *
     * @param string $financialContribution
     * @return Hosts
     */
    public function setFinancialContribution($financialContribution)
    {
        $this->financialContribution = $financialContribution;

        return $this;
    }

    /**
     * Get financialContribution
     *
     * @return string
     */
    public function getFinancialContribution()
    {
        return $this->financialContribution;
    }

    /**
     * Set wivesClub
     *
     * @param string $wivesClub
     * @return Hosts
     */
    public function setWivesClub($wivesClub)
    {
        $this->wivesClub = $wivesClub;

        return $this;
    }

    /**
     * Get wivesClub
     *
     * @return string
     */
    public function getWivesClub()
    {
        return $this->wivesClub;
    }

    /**
     * Set eventHelp
     *
     * @param string $eventHelp
     * @return Hosts
     */
    public function setEventHelp($eventHelp)
    {
        $this->eventHelp = $eventHelp;

        return $this;
    }

    /**
     * Get eventHelp
     *
     * @return string
     */
    public function getEventHelp()
    {
        return $this->eventHelp;
    }

    /**
     * Set festival
     *
     * @param string $festival
     * @return Hosts
     */
    public function setFestival($festival)
    {
        $this->festival = $festival;

        return $this;
    }

    /**
     * Get festival
     *
     * @return string
     */
    public function getFestival()
    {
        return $this->festival;
    }

    /**
     * Set bakeDessert
     *
     * @param string $bakeDessert
     * @return Hosts
     */
    public function setBakeDessert($bakeDessert)
    {
        $this->bakeDessert = $bakeDessert;

        return $this;
    }

    /**
     * Get bakeDessert
     *
     * @return string
     */
    public function getBakeDessert()
    {
        return $this->bakeDessert;
    }

    /**
     * Set manBooth
     *
     * @param string $manBooth
     * @return Hosts
     */
    public function setManBooth($manBooth)
    {
        $this->manBooth = $manBooth;

        return $this;
    }

    /**
     * Get manBooth
     *
     * @return string
     */
    public function getManBooth()
    {
        return $this->manBooth;
    }

    /**
     * Set englishClass
     *
     * @param string $englishClass
     * @return Hosts
     */
    public function setEnglishClass($englishClass)
    {
        $this->englishClass = $englishClass;

        return $this;
    }

    /**
     * Get englishClass
     *
     * @return string
     */
    public function getEnglishClass()
    {
        return $this->englishClass;
    }

    /**
     * Set fallEnglishClass
     *
     * @param string $fallEnglishClass
     * @return Hosts
     */
    public function setFallEnglishClass($fallEnglishClass)
    {
        $this->fallEnglishClass = $fallEnglishClass;

        return $this;
    }

    /**
     * Get fallEnglishClass
     *
     * @return string
     */
    public function getFallEnglishClass()
    {
        return $this->fallEnglishClass;
    }

    /**
     * Set springEnglishClass
     *
     * @param string $springEnglishClass
     * @return Hosts
     */
    public function setSpringEnglishClass($springEnglishClass)
    {
        $this->springEnglishClass = $springEnglishClass;

        return $this;
    }

    /**
     * Get springEnglishClass
     *
     * @return string
     */
    public function getSpringEnglishClass()
    {
        return $this->springEnglishClass;
    }

    /**
     * Set summerEnglishClass
     *
     * @param string $summerEnglishClass
     * @return Hosts
     */
    public function setSummerEnglishClass($summerEnglishClass)
    {
        $this->summerEnglishClass = $summerEnglishClass;

        return $this;
    }

    /**
     * Get summerEnglishClass
     *
     * @return string
     */
    public function getSummerEnglishClass()
    {
        return $this->summerEnglishClass;
    }

    /**
     * Set shopping
     *
     * @param string $shopping
     * @return Hosts
     */
    public function setShopping($shopping)
    {
        $this->shopping = $shopping;

        return $this;
    }

    /**
     * Get shopping
     *
     * @return string
     */
    public function getShopping()
    {
        return $this->shopping;
    }

    /**
     * Set groupOuting
     *
     * @param string $groupOuting
     * @return Hosts
     */
    public function setGroupOuting($groupOuting)
    {
        $this->groupOuting = $groupOuting;

        return $this;
    }

    /**
     * Get groupOuting
     *
     * @return string
     */
    public function getGroupOuting()
    {
        return $this->groupOuting;
    }

    /**
     * Set provideMeal
     *
     * @param string $provideMeal
     * @return Hosts
     */
    public function setProvideMeal($provideMeal)
    {
        $this->provideMeal = $provideMeal;

        return $this;
    }

    /**
     * Get provideMeal
     *
     * @return string
     */
    public function getProvideMeal()
    {
        return $this->provideMeal;
    }

    /**
     * Set recruitment
     *
     * @param string $recruitment
     * @return Hosts
     */
    public function setRecruitment($recruitment)
    {
        $this->recruitment = $recruitment;

        return $this;
    }

    /**
     * Get recruitment
     *
     * @return string
     */
    public function getRecruitment()
    {
        return $this->recruitment;
    }

    /**
     * Set referenceName
     *
     * @param string $referenceName
     * @return Hosts
     */
    public function setReferenceName($referenceName)
    {
        $this->referenceName = $referenceName;

        return $this;
    }

    /**
     * Get referenceName
     *
     * @return string
     */
    public function getReferenceName()
    {
        return $this->referenceName;
    }

    /**
     * Set referencePhone
     *
     * @param string $referencePhone
     * @return Hosts
     */
    public function setReferencePhone($referencePhone)
    {
        $this->referencePhone = $referencePhone;

        return $this;
    }

    /**
     * Get referencePhone
     *
     * @return string
     */
    public function getReferencePhone()
    {
        return $this->referencePhone;
    }

    /**
     * Set referenceEmail
     *
     * @param string $referenceEmail
     * @return Hosts
     */
    public function setReferenceEmail($referenceEmail)
    {
        $this->referenceEmail = $referenceEmail;

        return $this;
    }

    /**
     * Get referenceEmail
     *
     * @return string
     */
    public function getReferenceEmail()
    {
        return $this->referenceEmail;
    }

    /**
     * Set active
     *
     * @param string $active
     * @return Hosts
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
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set submitTime
     *
     * @param string $submitTime
     * @return Hosts
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
