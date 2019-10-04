<?php

namespace CAIF\SharedBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use CAIF\SharedBundle\Traits\TimestampableTrait;
use CAIF\SharedBundle\Entity\Person;

/**
 * @ORM\Entity()
 * @ORM\Table(name="student")
 */
class Student extends Person
{
    use TimestampableTrait;

    public function __toString()
    {
        return ucwords($this->firstName).' '.ucwords($this->lastName);
    }

    public function toArray()
    {
        return [
            $this->firstName,
            $this->lastName,
            $this->email,
            $this->phone,
        ];
    }

    public function isGreenville()
    {
        $city = strtolower($this->city);

        if ($city == "greenville") {
            return true;
        }

        return false;
    }

    public static function getAllAreasOfStudy()
    {
        return [
            'Accounting'                                             => 'Accounting',
            'Administration and Supervision'                         => 'Administration and Supervision',
            'Agricultural Education'                                 => 'Agricultural Education',
            'Agricultural Mechanization and Business'                => 'Agricultural Mechanization and Business',
            'Animal and Vaterinary Sciences'                         => 'Animal and Vaterinary Sciences',
            'Anthropology'                                           => 'Anthropology',
            'Applied Economics'                                      => 'Applied Economics',
            'Applied Psychology'                                     => 'Applied Psychology',
            'Applied Sociology'                                      => 'Applied Sociology',
            'Architecture'                                           => 'Architecture',
            'Art'                                                    => 'Art',
            'Automotive Engineering'                                 => 'Automotive Engineering',
            'Biochemistry'                                           => 'Biochemistry',
            'Biochemistry and Molecular Biology'                     => 'Biochemistry and Molecular Biology',
            'Bioengineering'                                         => 'Bioengineering',
            'Biological Sciences'                                    => 'Biological Sciences',
            'Biosystems Engineering'                                 => 'Biosystems Engineering',
            'Business Administration'                                => 'Business Administration',
            'Chemical Engineering'                                   => 'Chemical Engineering',
            'City and Regional Planning'                             => 'City and Regional Planning',
            'Civil Engineering'                                      => 'Civil Engineering',
            'Communication Studies'                                  => 'Communication Studies',
            'Communication, Technology and Society'                  => 'Communication, Technology and Society',
            'Computer Engineering'                                   => 'Computer Engineering',
            'Computer Information Systems'                           => 'Computer Information Systems',
            'Computer Science'                                       => 'Computer Science',
            'Construction Science and Management'                    => 'Construction Science and Management',
            'Counselor Education, Clinical Mental Health Counseling' => 'Counselor Education, Clinical Mental Health Counseling',
            'Counselor Education, School Counseling'                 => 'Counselor Education, School Counseling',
            'Counselor Education, Student Affairs'                   => 'Counselor Education, Student Affairs',
            'Curriculum and Instruction'                             => 'Curriculum and Instruction',
            'Digital Production Arts'                                => 'Digital Production Arts',
            'Early Childhood Education'                              => 'Early Childhood Education',
            'Economics'                                              => 'Economics',
            'Educational Leadership'                                 => 'Educational Leadership',
            'Electrical Engineering'                                 => 'Electrical Engineering',
            'Elementary Education'                                   => 'Elementary Education',
            'Engineering and Science Education'                      => 'Engineering and Science Education',
            'English'                                                => 'English',
            'Entomology'                                             => 'Entomology',
            'Envionmental and Natrual Resources'                     => 'Envionmental and Natrual Resources',
            'Environmental Engineering'                              => 'Environmental Engineering',
            'Environmental Engineering and Science'                  => 'Environmental Engineering and Science',
            'Environmental Toxicology'                               => 'Environmental Toxicology',
            'Financial Management'                                   => 'Financial Management',
            'Food, Nutrition and Culinary Sciences'                  => 'Food, Nutrition and Culinary Sciences',
            'Food Science'                                           => 'Food Science',
            'Food Technology'                                        => 'Food Technology',
            'Forest Resource Management'                             => 'Forest Resource Management',
            'Genetics'                                               => 'Genetics',
            'Geology'                                                => 'Geology',
            'Grapic Communications'                                  => 'Grapic Communications',
            'Healthcare Genetics'                                    => 'Healthcare Genetics',
            'Healthcare Science'                                     => 'Healthcare Science',
            'Historic Presernation'                                  => 'Historic Presernation',
            'History'                                                => 'History',
            'Horticulture'                                           => 'Horticulture',
            'Human-Centered Computing'                               => 'Human-Centered Computing',
            'Human Factors Psychology'                               => 'Human Factors Psychology',
            'Human Resource Development'                             => 'Human Resource Development',
            'Hydrogeology'                                           => 'Hydrogeology',
            'Industrial Engineering'                                 => 'Industrial Engineering',
            'Industrial/Organizational Psychology'                   => 'Industrial/Organizational Psychology',
            'International Family and Community Studies'             => 'International Family and Community Studies',
            'Landscape Architecture'                                 => 'Landscape Architecture',
            'Language and International Health'                      => 'Language and International Health',
            'Language and International Trade'                       => 'Language and International Trade',
            'Literacy'                                               => 'Literacy',
            'Management'                                             => 'Management',
            'Marketing'                                              => 'Marketing',
            'Materials Science and Engineering'                      => 'Materials Science and Engineering',
            'Mathematical Sciences'                                  => 'Mathematical Sciences',
            'Mathematics Teaching'                                   => 'Mathematics Teaching',
            'Mechanical Engineering'                                 => 'Mechanical Engineering',
            'Microbiology'                                           => 'Microbiology',
            'Middle Level Education'                                 => 'Middle Level Education',
            'Modern Languages'                                       => 'Modern Languages',
            'Nursing'                                                => 'Nursing',
            'Packaging Science'                                      => 'Packaging Science',
            'Parks, Recreation and Tourism Management'               => 'Parks, Recreation and Tourism Management',
            'Philosophy'                                             => 'Philosophy',
            'Photonic Science and Technology'                        => 'Photonic Science and Technology',
            'Physics'                                                => 'Physics',
            'Planning, Design and Built Environment'                 => 'Planning, Design and Built Environment',
            'Plant and Environmental Sciences'                       => 'Plant and Environmental Sciences',
            'Policy Studies'                                         => 'Policy Studies',
            'Political Science'                                      => 'Political Science',
            'Prepharmacy'                                            => 'Prepharmacy',
            'Preprofessional Health Studies'                         => 'Preprofessional Health Studies',
            'Prerehabilitation Sciences'                             => 'Prerehabilitation Sciences',
            'Preveterinary Medicine'                                 => 'Preveterinary Medicine',
            'Production Studies in Performing Arts'                  => 'Production Studies in Performing Arts',
            'Professional Communication'                             => 'Professional Communication',
            'Psychology'                                             => 'Psychology',
            'Public Administration'                                  => 'Public Administration',
            'Real Estate Development'                                => 'Real Estate Development',
            'Rhetorics, Communication and Information Design'        => 'Rhetorics, Communication and Information Design',
            'Science Teaching'                                       => 'Science Teaching',
            'Secondary Education'                                    => 'Secondary Education',
            'Secondary Mathematics'                                  => 'Secondary Mathematics',
            'Secondary Science'                                      => 'Secondary Science',
            'Sociology'                                              => 'Sociology',
            'Soils and Sustainable Crop Systems'                     => 'Soils and Sustainable Crop Systems',
            'Special Education'                                      => 'Special Education',
            'Teaching and Learning'                                  => 'Teaching and Learning',
            'Turfgrass'                                              => 'Turfgrass',
            'Wildlife and Fisheries Biology'                         => 'Wildlife and Fisheries Biology',
            'Youth Development Leadership'                           => 'Youth Development Leadership',
        ];
    }

    public static function getAllDegreePrograms()
    {
        return [
            'Undergraduate'    => 'Undergraduate',
            'Masters'          => 'Masters',
            'PH.D.'            => 'PH.D.',
            'Post Doc.'        => 'Post Doc.',
            'Visiting Scholar' => 'Visiting Scholar',
        ];
    }

    public function getHomeCountryName()
    {
        $countries = Person::getCountryList();

        if ($this->homeCountry == "") {
            return null;
        }

        return $countries[$this->homeCountry];
    }

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

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
     * @ORM\Column(name="birthday", type="date", length=255, nullable=true)
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
     * @ORM\Column(name="dog_cat_presence", type="boolean", nullable=true)
     */
    private $dogCatPresence;

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
     * @ORM\Column(name="dne_foods", type="text", nullable=true)
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
     * @ORM\Column(name="kid_status", type="string", length=255)
     */
    private $kidStatus;

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
     * @ORM\Column(name="photo", type="text", nullable=true)
     */
    private $photo;

    /**
     * @ORM\Column(name="legacy_id", type="integer", nullable=true)
     */
    private $legacyId;

    /**
     * @ORM\Column(name="legacy_host_id", type="integer", nullable=true)
     */
    private $legacyHostId;

    /**
     * @ORM\ManyToOne(targetEntity="Host", inversedBy="students")
     * @ORM\JoinColumn(name="host_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $host;

    /**
     * @ORM\Column(name="host_not_needed", type="boolean")
     */
    private $hostNotNeeded = false;

    // /**
    //  * @ORM\Column(name="created_at", type="integer", nullable=true)
    //  */
    // private $createdAt;

    // /**
    //  * @ORM\Column(name="updated_at", type="integer", nullable=true)
    //  */
    // private $updatedAt;


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
        return ucwords($this->firstName);
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
        return ucwords($this->lastName);
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
        return ucwords(strtolower($this->apartmentComplex));
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
     * Set dogCatPresence
     *
     * @param string $dogCatPresence
     * @return Student
     */
    public function setDogCatPresence($dogCatPresence)
    {
        $this->dogCatPresence = $dogCatPresence;

        return $this;
    }

    /**
     * Get dogCatPresence
     *
     * @return string
     */
    public function isDogCatPresence()
    {
        return $this->dogCatPresence;
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
     * Set kidStatus
     *
     * @param string $kidStatus
     * @return Student
     */
    public function setKidStatus($kidStatus)
    {
        $this->kidStatus = $kidStatus;

        return $this;
    }

    /**
     * Get kidStatus
     *
     * @return string
     */
    public function getKidStatus()
    {
        return $this->kidStatus;
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
     * Set legacyId
     *
     * @param string $legacyId
     * @return Student
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
     * Set legacyHostId
     *
     * @param string $legacyHostId
     * @return Student
     */
    public function setLegacyHostId($legacyHostId)
    {
        $this->legacyHostId = $legacyHostId;

        return $this;
    }

    /**
     * Get legacyHostId
     *
     * @return string
     */
    public function getLegacyHostId()
    {
        return $this->legacyHostId;
    }

    /**
     * Set host
     *
     * @param string $host
     * @return Student
     */
    public function setHost($host = null)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * Get host
     *
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Set hostNotNeeded
     *
     * @param string $hostNotNeeded
     * @return Student
     */
    public function setHostNotNeeded($hostNotNeeded)
    {
        $this->hostNotNeeded = $hostNotNeeded;

        return $this;
    }

    /**
     * Get hostNotNeeded
     *
     * @return string
     */
    public function isHostNotNeeded()
    {
        return $this->hostNotNeeded;
    }

    // /**
    //  * Set createdAt
    //  *
    //  * @param string $createdAt
    //  * @return Student
    //  */
    // public function setCreatedAt($createdAt)
    // {
    //     $this->createdAt = $createdAt;

    //     return $this;
    // }

    // /**
    //  * Get createdAt
    //  *
    //  * @return string
    //  */
    // public function getCreatedAt()
    // {
    //     return $this->createdAt;
    // }

    // /**
    //  * Set updatedAt
    //  *
    //  * @param string $updatedAt
    //  * @return Student
    //  */
    // public function setUpdatedAt($updatedAt)
    // {
    //     $this->updatedAt = $updatedAt;

    //     return $this;
    // }

    // /**
    //  * Get updatedAt
    //  *
    //  * @return string
    //  */
    // public function getUpdatedAt()
    // {
    //     return $this->updatedAt;
    // }
}
