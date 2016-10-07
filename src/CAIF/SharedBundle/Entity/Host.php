<?php

namespace CAIF\SharedBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use CAIF\SharedBundle\Traits\TimestampableTrait;

/**
 * @ORM\Entity()
 * @ORM\Table(name="host")
 */
class Host extends Person
{
    use TimestampableTrait;

    public function __toString()
    {
        return $this->name;
    }

    public function bestPhone()
    {
        if ($this->mobilePhone !== null) {
            return $this->mobilePhone;
        } elseif ($this->homePhone !== null) {
            return $this->homePhone;
        } elseif ($this->workPhone !== null) {
            return $this->workPhone;
        }

        return null;
    }

    public function preferences()
    {
        $preference = null;
        if ($this->studentType != 'No preference') {
            $preference = $this->studentType;
        }
        if ($this->studentCountry != " " && $this->studentCountry != null && $this->studentCountry != 'any') {
            if ($preference === null) {
                $preference = $this->getCountryList()[$this->studentCountry];
            } else {
                $preference = $preference.' - '.$this->getCountryList()[$this->studentCountry];
            }
        }

        if ($preference === null) {
            return '<i class="light-grey">None</i>';
        }

        return $preference;
    }

    public function getLastName()
    {
        $explode  = explode(" ", $this->name);
        $lastName = end($explode);

        return $lastName;
    }

    public static function getStatesList()
    {
        return [
            'AL' => 'Alabama',
            'AK' => 'Alaska',
            'AZ' => 'Arizona',
            'AR' => 'Arkansas',
            'CA' => 'California',
            'CO' => 'Colorado',
            'CT' => 'Connecticut',
            'DE' => 'Delaware',
            'DC' => 'District of Columbia',
            'FL' => 'Florida',
            'GA' => 'Georgia',
            'HI' => 'Hawaii',
            'ID' => 'Idaho',
            'IL' => 'Illinois',
            'IN' => 'Indiana',
            'IA' => 'Iowa',
            'KS' => 'Kansas',
            'KY' => 'Kentucky',
            'LA' => 'Louisiana',
            'ME' => 'Maine',
            'MD' => 'Maryland',
            'MA' => 'Massachusetts',
            'MI' => 'Michigan',
            'MN' => 'Minnesota',
            'MS' => 'Mississippi',
            'MO' => 'Missouri',
            'MT' => 'Montana',
            'NE' => 'Nebraska',
            'NV' => 'Nevada',
            'NH' => 'New Hampshire',
            'NJ' => 'New Jersey',
            'NM' => 'New Mexico',
            'NY' => 'New York',
            'NC' => 'North Carolina',
            'ND' => 'North Dakota',
            'OH' => 'Ohio',
            'OK' => 'Oklahoma',
            'OR' => 'Oregon',
            'PA' => 'Pennsylvania',
            'RI' => 'Rhode Island',
            'SC' => 'South Carolina',
            'SD' => 'South Dakota',
            'TN' => 'Tennessee',
            'TX' => 'Texas',
            'UT' => 'Utah',
            'VT' => 'Vermont',
            'VA' => 'Virginia',
            'WA' => 'Washington',
            'WV' => 'West Virginia',
            'WI' => 'Wisconsin',
            'WY' => 'Wyoming',
        ];
    }

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="legacy_id", type="integer", nullable=true)
     */
    private $legacyId;

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
     * @ORM\Column(name="secondary_email", type="string", length=255, nullable=true)
     */
    private $secondaryEmail;

    /**
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @ORM\Column(name="children", type="array")
     *
     * - options: none, small, teenage, college, grown
     */
    private $children;

    /**
     * @ORM\Column(name="pet_status", type="string", length=255)
     *
     * - options: no, outside, inside, both inside and outside
     */
    private $petStatus;

    /**
     * @ORM\Column(name="pet_type", type="string", length=255, nullable=true)
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
     * @ORM\Column(name="student_type", type="string", length=255)
     *
     * - options: none, male, female, married
     */
    private $studentType;

    /**
     * @ORM\Column(name="student_country", type="string", length=255, nullable=true)
     */
    private $studentCountry;

    /**
     * @ORM\Column(name="max_students", type="integer", nullable=true)
     */
    private $maxStudents;

    /**
     * @ORM\Column(name="hosting", type="boolean")
     */
    private $hosting;

    /**
     * @ORM\Column(name="wives_club", type="boolean")
     */
    private $wivesClub;

    /**
     * @ORM\Column(name="event_help", type="boolean")
     */
    private $eventHelp;

    /**
     * @ORM\Column(name="shopping", type="boolean")
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
     * @ORM\OneToMany(targetEntity="Student", mappedBy="host", cascade={"remove"})
     */
    private $students;


    /**
     * Set legacyId
     *
     * @param string $legacyId
     * @return Host
     */
    public function setLegacyId($legacyId)
    {
        $this->legacyId = $legacyId;

        return $this;
    }

    /**
     * Get legacyId
     *
     * @return string
     */
    public function getLegacyId()
    {
        return $this->legacyId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Host
     */
    public function setName($name)
    {
        $this->name = trim($name);

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
     * @return Host
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
     * @return Host
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
     * @return Host
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
     * @return Host
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
     * @return Host
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
     * @return Host
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
     * @return Host
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
     * @return Host
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
     * Set secondaryEmail
     *
     * @param string $secondaryEmail
     * @return Host
     */
    public function setSecondaryEmail($secondaryEmail)
    {
        $this->secondaryEmail = $secondaryEmail;

        return $this;
    }

    /**
     * Get secondaryEmail
     *
     * @return string
     */
    public function getSecondaryEmail()
    {
        return $this->secondaryEmail;
    }

    /**
     * Set photo
     *
     * @param string $photo
     * @return Host
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
     * Set children
     *
     * @param string $children
     * @return Host
     */
    public function setChildren($children)
    {
        $this->children = $children;

        return $this;
    }

    /**
     * Get children
     *
     * @return string
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set petStatus
     *
     * @param string $petStatus
     * @return Host
     */
    public function setPetStatus($petStatus)
    {
        $this->petStatus = $petStatus;

        return $this;
    }

    /**
     * Get petStatus
     *
     * @return string
     */
    public function getPetStatus()
    {
        return $this->petStatus;
    }

    /**
     * Set petType
     *
     * @param string $petType
     * @return Host
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
     * @return Host
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
     * @return Host
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
     * @return Host
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
     * @return Host
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
     * @return Host
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
     * @return Host
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
     * @return Host
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
    public function isHosting()
    {
        return $this->hosting;
    }

    /**
     * Set wivesClub
     *
     * @param string $wivesClub
     * @return Host
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
    public function isWivesClub()
    {
        return $this->wivesClub;
    }

    /**
     * Set eventHelp
     *
     * @param string $eventHelp
     * @return Host
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
    public function isEventHelp()
    {
        return $this->eventHelp;
    }

    /**
     * Set shopping
     *
     * @param string $shopping
     * @return Host
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
    public function isShopping()
    {
        return $this->shopping;
    }

    /**
     * Set groupOuting
     *
     * @param string $groupOuting
     * @return Host
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
    public function isGroupOuting()
    {
        return $this->groupOuting;
    }

    /**
     * Set provideMeal
     *
     * @param string $provideMeal
     * @return Host
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
    public function isProvideMeal()
    {
        return $this->provideMeal;
    }

    /**
     * Set referenceName
     *
     * @param string $referenceName
     * @return Host
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
     * @return Host
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
     * @return Host
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
     * Set students
     *
     * @param string $students
     * @return Host
     */
    public function setStudents($students)
    {
        $this->students = $students;

        return $this;
    }

    /**
     * Get students
     *
     * @return string
     */
    public function getStudents()
    {
        return $this->students;
    }
}
