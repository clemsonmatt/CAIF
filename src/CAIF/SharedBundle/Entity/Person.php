<?php

namespace CAIF\SharedBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * @ORM\Entity()
 * @UniqueEntity(fields={"email"}, message="This email address is already in use.")
 * @UniqueEntity(fields={"username"}, message="This username is not available.")
 * @ORM\Table(name="person")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="entity", type="string")
 * @ORM\DiscriminatorMap({
 *      "host"    = "Host",
 *      "student" = "Student",
 *      "admin"   = "Admin",
 * })
 */
abstract class Person implements AdvancedUserInterface
{
    public function getEntityType()
    {
        $classParts = explode('\\', get_called_class());
        return array_pop($classParts);
    }

    public static function getCountryList($showNP = true)
    {
        if ($showNP) {
            $np = ["any" => 'No Preference'];
        }

        $list = [
            "AF" => 'Afghanistan',
            "AL" => 'Albania',
            "DZ" => 'Algeria',
            "AS" => 'American Samoa',
            "AD" => 'Andorra',
            "AO" => 'Angola',
            "AI" => 'Anguilla',
            "AQ" => 'Antarctica',
            "AG" => 'Antigua and Barbuda',
            "AR" => 'Argentina',
            "AM" => 'Armenia',
            "AW" => 'Aruba',
            "AU" => 'Australia',
            "AT" => 'Austria',
            "AZ" => 'Azerbaijan',
            "BS" => 'Bahamas',
            "BH" => 'Bahrain',
            "BD" => 'Bangladesh',
            "BB" => 'Barbados',
            "BY" => 'Belarus',
            "BE" => 'Belgium',
            "BZ" => 'Belize',
            "BJ" => 'Benin',
            "BM" => 'Bermuda',
            "BT" => 'Bhutan',
            "BO" => 'Bolivia',
            "BA" => 'Bosnia and Herzegowina',
            "BW" => 'Botswana',
            "BV" => 'Bouvet Island',
            "BR" => 'Brazil',
            "IO" => 'British Indian Ocean Territory',
            "BN" => 'Brunei Darussalam',
            "BG" => 'Bulgaria',
            "BF" => 'Burkina Faso',
            "BI" => 'Burundi',
            "KH" => 'Cambodia',
            "CM" => 'Cameroon',
            "CA" => 'Canada',
            "CV" => 'Cape Verde',
            "KY" => 'Cayman Islands',
            "CF" => 'Central African Republic',
            "TD" => 'Chad',
            "CL" => 'Chile',
            "CN" => 'China',
            "CX" => 'Christmas Island',
            "CC" => 'Cocos (Keeling) Islands',
            "CO" => 'Colombia',
            "KM" => 'Comoros',
            "CG" => 'Congo',
            "CD" => 'Congo, the Democratic Republic of the',
            "CK" => 'Cook Islands',
            "CR" => 'Costa Rica',
            "CI" => 'Cote d\'Ivoire',
            "HR" => 'Croatia (Hrvatska)',
            "CU" => 'Cuba',
            "CY" => 'Cyprus',
            "CZ" => 'Czech Republic',
            "DK" => 'Denmark',
            "DJ" => 'Djibouti',
            "DM" => 'Dominica',
            "DO" => 'Dominican Republic',
            "TP" => 'East Timor',
            "EC" => 'Ecuador',
            "EG" => 'Egypt',
            "SV" => 'El Salvador',
            "GQ" => 'Equatorial Guinea',
            "ER" => 'Eritrea',
            "EE" => 'Estonia',
            "ET" => 'Ethiopia',
            "FK" => 'Falkland Islands (Malvinas)',
            "FO" => 'Faroe Islands',
            "FJ" => 'Fiji',
            "FI" => 'Finland',
            "FR" => 'France',
            "FX" => 'France, Metropolitan',
            "GF" => 'French Guiana',
            "PF" => 'French Polynesia',
            "TF" => 'French Southern Territories',
            "GA" => 'Gabon',
            "GM" => 'Gambia',
            "GE" => 'Georgia',
            "DE" => 'Germany',
            "GH" => 'Ghana',
            "GI" => 'Gibraltar',
            "GR" => 'Greece',
            "GL" => 'Greenland',
            "GD" => 'Grenada',
            "GP" => 'Guadeloupe',
            "GU" => 'Guam',
            "GT" => 'Guatemala',
            "GN" => 'Guinea',
            "GW" => 'Guinea-Bissau',
            "GY" => 'Guyana',
            "HT" => 'Haiti',
            "HM" => 'Heard and Mc Donald Islands',
            "VA" => 'Holy See (Vatican City State)',
            "HN" => 'Honduras',
            "HK" => 'Hong Kong',
            "HU" => 'Hungary',
            "IS" => 'Iceland',
            "IN" => 'India',
            "ID" => 'Indonesia',
            "IR" => 'Iran (Islamic Republic of)',
            "IQ" => 'Iraq',
            "IE" => 'Ireland',
            "IL" => 'Israel',
            "IT" => 'Italy',
            "JM" => 'Jamaica',
            "JP" => 'Japan',
            "JO" => 'Jordan',
            "KZ" => 'Kazakhstan',
            "KE" => 'Kenya',
            "KI" => 'Kiribati',
            "KP" => 'Korea, Democratic People\'s Republic of',
            "KR" => 'Korea, Republic of',
            "KW" => 'Kuwait',
            "KG" => 'Kyrgyzstan',
            "LA" => 'Lao People\'s Democratic Republic',
            "LV" => 'Latvia',
            "LB" => 'Lebanon',
            "LS" => 'Lesotho',
            "LR" => 'Liberia',
            "LY" => 'Libyan Arab Jamahiriya',
            "LI" => 'Liechtenstein',
            "LT" => 'Lithuania',
            "LU" => 'Luxembourg',
            "MO" => 'Macau',
            "MK" => 'Macedonia, The Former Yugoslav Republic of',
            "MG" => 'Madagascar',
            "MW" => 'Malawi',
            "MY" => 'Malaysia',
            "MV" => 'Maldives',
            "ML" => 'Mali',
            "MT" => 'Malta',
            "MH" => 'Marshall Islands',
            "MQ" => 'Martinique',
            "MR" => 'Mauritania',
            "MU" => 'Mauritius',
            "YT" => 'Mayotte',
            "MX" => 'Mexico',
            "FM" => 'Micronesia, Federated States of',
            "MD" => 'Moldova, Republic of',
            "MC" => 'Monaco',
            "MN" => 'Mongolia',
            "MS" => 'Montserrat',
            "MA" => 'Morocco',
            "MZ" => 'Mozambique',
            "MM" => 'Myanmar',
            "NA" => 'Namibia',
            "NR" => 'Nauru',
            "NP" => 'Nepal',
            "NL" => 'Netherlands',
            "AN" => 'Netherlands Antilles',
            "NC" => 'New Caledonia',
            "NZ" => 'New Zealand',
            "NI" => 'Nicaragua',
            "NE" => 'Niger',
            "NG" => 'Nigeria',
            "NU" => 'Niue',
            "NF" => 'Norfolk Island',
            "MP" => 'Northern Mariana Islands',
            "NO" => 'Norway',
            "OM" => 'Oman',
            "PK" => 'Pakistan',
            "PW" => 'Palau',
            "PA" => 'Panama',
            "PG" => 'Papua New Guinea',
            "PY" => 'Paraguay',
            "PE" => 'Peru',
            "PH" => 'Philippines',
            "PN" => 'Pitcairn',
            "PL" => 'Poland',
            "PT" => 'Portugal',
            "PR" => 'Puerto Rico',
            "QA" => 'Qatar',
            "RE" => 'Reunion',
            "RO" => 'Romania',
            "RU" => 'Russian Federation',
            "RW" => 'Rwanda',
            "KN" => 'Saint Kitts and Nevis',
            "LC" => 'Saint LUCIA',
            "VC" => 'Saint Vincent and the Grenadines',
            "WS" => 'Samoa',
            "SM" => 'San Marino',
            "ST" => 'Sao Tome and Principe',
            "SA" => 'Saudi Arabia',
            "SN" => 'Senegal',
            "SC" => 'Seychelles',
            "SL" => 'Sierra Leone',
            "SG" => 'Singapore',
            "SK" => 'Slovakia (Slovak Republic)',
            "SI" => 'Slovenia',
            "SB" => 'Solomon Islands',
            "SO" => 'Somalia',
            "ZA" => 'South Africa',
            "GS" => 'South Georgia and the South Sandwich Islands',
            "ES" => 'Spain',
            "LK" => 'Sri Lanka',
            "SH" => 'St. Helena',
            "PM" => 'St. Pierre and Miquelon',
            "SD" => 'Sudan',
            "SR" => 'Suriname',
            "SJ" => 'Svalbard and Jan Mayen Islands',
            "SZ" => 'Swaziland',
            "SE" => 'Sweden',
            "CH" => 'Switzerland',
            "SY" => 'Syrian Arab Republic',
            "TW" => 'Taiwan',
            "TJ" => 'Tajikistan',
            "TZ" => 'Tanzania, United Republic of',
            "TH" => 'Thailand',
            "TG" => 'Togo',
            "TK" => 'Tokelau',
            "TO" => 'Tonga',
            "TT" => 'Trinidad and Tobago',
            "TN" => 'Tunisia',
            "TR" => 'Turkey',
            "TM" => 'Turkmenistan',
            "TC" => 'Turks and Caicos Islands',
            "TV" => 'Tuvalu',
            "UG" => 'Uganda',
            "UA" => 'Ukraine',
            "AE" => 'United Arab Emirates',
            "GB" => 'United Kingdom',
            "US" => 'United States',
            "UM" => 'United States Minor Outlying Islands',
            "UY" => 'Uruguay',
            "UZ" => 'Uzbekistan',
            "VU" => 'Vanuatu',
            "VE" => 'Venezuela',
            "VN" => 'Viet Nam',
            "VG" => 'Virgin Islands (British)',
            "VI" => 'Virgin Islands (U.S.)',
            "WF" => 'Wallis and Futuna Islands',
            "EH" => 'Western Sahara',
            "YE" => 'Yemen',
            "YU" => 'Yugoslavia',
            "ZM" => 'Zambia',
            "ZW" => 'Zimbabwe',
        ];

        if ($showNP) {
            return array_merge($np, $list);
        }

        return $list;
    }

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=3, max=255)
     * @ORM\Column(name="username", type="string", length=255)
     */
    protected $username;

    /**
     * @ORM\Column(name="password", type="string", length=255)
     * @Assert\Length(
     *     min = 8,
     *     minMessage = "Password should be at least 8 chars long",
     *     max = 255,
     *     maxMessage = "Password should be no more than 255 chars long"
     * )
     */
    protected $password;

    /**
     * @ORM\Column(name="temp_password", type="string", length=255, nullable=true)
     */
    private $tempPassword;

    /**
     * @ORM\Column(name="roles", type="array")
     */
    private $roles;

    /**
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @ORM\Column(name="updated_password", type="boolean", options={"default" = 0})
     */
    private $updatedPassword = true;

    /**
     * @ORM\OneToMany(targetEntity="Rsvp", mappedBy="person")
     */
    private $rsvps;


    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
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
     * Set password
     *
     * @param string $password
     * @return Person
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set tempPassword
     *
     * @param string $tempPassword
     * @return Person
     */
    public function setTempPassword($tempPassword)
    {
        $this->tempPassword = $tempPassword;

        return $this;
    }

    /**
     * Get tempPassword
     *
     * @return string
     */
    public function getTempPassword()
    {
        return $this->tempPassword;
    }

    /**
     * Set roles
     *
     * @param string $roles
     * @return Person
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get roles
     *
     * @return string
     */
    public function getRoles()
    {
        return $this->roles;
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
     * Set updatedPassword
     *
     * @param string $updatedPassword
     * @return Person
     */
    public function setUpdatedPassword($updatedPassword)
    {
        $this->updatedPassword = $updatedPassword;

        return $this;
    }

    /**
     * Get updatedPassword
     *
     * @return string
     */
    public function isUpdatedPassword()
    {
        return $this->updatedPassword;
    }

    /**
     * Set rsvps
     *
     * @param string $rsvps
     * @return Person
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
