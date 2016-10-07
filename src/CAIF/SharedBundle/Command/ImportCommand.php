<?php

namespace CAIF\SharedBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\ProgressBar;

use CAIF\SharedBundle\Entity\Host;
use CAIF\SharedBundle\Entity\Person;
use CAIF\SharedBundle\Entity\Student;

class ImportCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('caif:import')
            ->setDescription('Import')
            ->addArgument('table', InputArgument::OPTIONAL, 'Which table?');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $table = $input->getArgument('table');
        if ($table) {
            switch ($table) {
                case 'students':
                    $status = $this->importStudents($output);
                    break;
                case 'hosts':
                    $status = $this->importHosts($output);
                    break;
            }
        } else {
            $status = 'Choose a table to import';
        }

        $output->writeln($status);
    }

    /**
     * Students
     */
    private function importStudents(OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');

        $repository   = $em->getRepository('CAIFSharedBundle:Students');
        $legacyPeople = $repository->findAll();

        $loginRepository = $em->getRepository('CAIFSharedBundle:Login');

        $progress = new ProgressBar($output, count($legacyPeople));
        $progress->start();

        /* all people */
        foreach ($legacyPeople as $person) {

            $newPerson = new Student();
            $newPerson->setUsername($person->getUsername());

            /* password */
            $login    = $loginRepository->findOneByUsername($person->getUsername());
            $factory  = $this->getContainer()->get('security.encoder_factory');
            $encoder  = $factory->getEncoder($newPerson);
            $password = $encoder->encodePassword($login->getPassword(), $newPerson->getSalt());
            $newPerson->setPassword($password);

            $newPerson->setRoles(['ROLE_USER']);
            $newPerson->setActive($person->isActive());

            $newPerson->setFirstName($person->getFirstName());
            $newPerson->setLastName($person->getLastName());
            $americanName = ($person->getAmericanName() === "" ? null : $person->getAmericanName());
            $newPerson->setAmericanName($americanName);

            $gender = 'male';
            if ($person->getGender() == 1) {
                $gender = 'female';
            }
            $newPerson->setGender($gender);

            $bday  = explode("/", $person->getBirthday());
            $month = null;
            if ($bday[0] == "Jan") {
                $month = '01';
            } elseif ($bday[0] == "Feb") {
                $month = '02';
            } elseif ($bday[0] == "Mar") {
                $month = '03';
            } elseif ($bday[0] == "Apr") {
                $month = '04';
            } elseif ($bday[0] == "May") {
                $month = '05';
            } elseif ($bday[0] == "Jun") {
                $month = '06';
            } elseif ($bday[0] == "Jul") {
                $month = '07';
            } elseif ($bday[0] == "Aug") {
                $month = '08';
            } elseif ($bday[0] == "Sep") {
                $month = '09';
            } elseif ($bday[0] == "Oct") {
                $month = '10';
            } elseif ($bday[0] == "Nov") {
                $month = '11';
            } elseif ($bday[0] == "Dec") {
                $month = '12';
            }

            if ($month !== null && $bday[1] != "Day" && $bday[2] != "Year") {
                $birthday = $month.'/'.$bday[1].'/'.$bday[2];
                $newPerson->setBirthday(new \DateTime($birthday));
            } else {
                $newPerson->setBirthday(null);
            }

            $phone = ($person->getPhone() === "" ? null : $person->getPhone());
            $newPerson->setPhone($phone);

            $email = ($person->getEmail() === "" ? null : $person->getEmail());
            $newPerson->setEmail($email);

            $aptComplex = ($person->getApartmentComplex() === "" ? null : $person->getApartmentComplex());
            $newPerson->setApartmentComplex($aptComplex);

            $aptNumber = ($person->getApartmentNumber() === "" ? null : $person->getApartmentNumber());
            $newPerson->setApartmentNumber($aptNumber);

            $mailingAddress = ($person->getMailingAddress() === "" ? null : $person->getMailingAddress());
            $newPerson->setMailingAddress($mailingAddress);

            $city = ($person->getCity() === "" ? null : $person->getCity());
            $newPerson->setCity(strtolower(ucwords($city)));

            $zip = ($person->getZip() === "" ? null : $person->getZip());
            $newPerson->setZip($zip);

            $areaOfStudy = ($person->getAreaOfStudy() === "" ? null : $person->getAreaOfStudy());
            $newPerson->setAreaOfStudy($areaOfStudy);

            $newPerson->setHomeCountry($person->getHomeCountry());

            $allergies = ($person->getAllergies() === "" ? null : $person->getAllergies());
            $newPerson->setAllergies($allergies);

            $degreeProgram = null;
            if ($person->getDegreeProgram() == 0) {
                $degreeProgram = "Undergraduate";
            } elseif ($person->getDegreeProgram() == 1) {
                $degreeProgram = "Masters";
            } elseif ($person->getDegreeProgram() == 2) {
                $degreeProgram = "PH.D.";
            } elseif ($person->getDegreeProgram() == 3) {
                $degreeProgram = "Post Doc.";
            } elseif ($person->getDegreeProgram() == 4) {
                $degreeProgram = "Visiting Scholar";
            }
            $newPerson->setDegreeProgram($degreeProgram);

            $languages = ($person->getLanguages() === "" ? null : $person->getLanguages());
            $newPerson->setLanguages($languages);

            $travel = ($person->getTravel() === "" ? null : $person->getTravel());
            $newPerson->setTravel($travel);

            $activities = ($person->getActivities() === "" ? null : $person->getActivities());
            $newPerson->setActivities($activities);

            $dneFoods = ($person->getDneFoods() === "" ? null : $person->getDneFoods());
            $newPerson->setDneFoods($dneFoods);

            $maritalStatus = 'single';
            if ($person->getMaritalStatus() == '1') {
                $maritalStatus = 'married';
            }
            $newPerson->setMaritalStatus($maritalStatus);
            $newPerson->setSpouseHere($person->getSpouseHere());

            $spouseName = ($person->getSpouseName() === "" ? null : $person->getSpouseName());
            $newPerson->setSpouseName($spouseName);

            $newPerson->setKidStatus($person->getKids());
            $newPerson->setKidsHere($person->getKidsHere());
            $newPerson->setSmoke($person->getSmoke());
            $newPerson->setCar($person->getCar());

            $photo = ($person->getPhoto() === "" ? null : $person->getPhoto());
            $newPerson->setPhoto($photo);

            $submitTime = strtotime($person->getSubmitTime());
            $newPerson->setCreatedAt($submitTime);
            $newPerson->setUpdatedAt($submitTime);

            $newPerson->setLegacyId($person->getId());
            $newPerson->setLegacyHostId($person->getHostId());

            $em->persist($newPerson);

            $progress->advance();
        }

        $em->flush();

        $progress->finish();

        return 'Successfully imported';
    }


    /**
     * Hosts
     */
    public function importHosts(OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');

        $repository   = $em->getRepository('CAIFSharedBundle:Hosts');
        $legacyPeople = $repository->findAll();

        $loginRepository = $em->getRepository('CAIFSharedBundle:Login');

        $progress = new ProgressBar($output, count($legacyPeople));
        $progress->start();

        /* all people */
        foreach ($legacyPeople as $person) {

            $newPerson = new Host();
            $newPerson->setUsername($person->getUsername());

            /* password */
            $login    = $loginRepository->findOneByUsername($person->getUsername());
            $factory  = $this->getContainer()->get('security.encoder_factory');
            $encoder  = $factory->getEncoder($newPerson);
            $password = $encoder->encodePassword($login->getPassword(), $newPerson->getSalt());
            $newPerson->setPassword($password);

            $newPerson->setRoles(['ROLE_USER']);
            $newPerson->setActive($person->getActive());

            $newPerson->setName($person->getName());
            $newPerson->setAddress($person->getAddress());
            $newPerson->setCity($person->getCity());
            $newPerson->setState($person->getState());
            $newPerson->setZip($person->getZip());
            $newPerson->setHomePhone($person->getHomePhone());
            $newPerson->setMobilePhone($person->getMobilePhone());
            $newPerson->setWorkPhone($person->getWorkPhone());
            $newPerson->setEmail($person->getEmail());

            $children = [];
            if ($person->getSmChild()) {
                $children[] = 'Small';
            }
            if ($person->getTnChild()) {
                $children[] = 'Teenage';
            }
            if ($person->getClChild()) {
                $children[] = 'College';
            }
            if ($person->getGrChild()) {
                $children[] = 'Grown';
            }
            if ($person->getNoChild()) {
                $children[] = 'None';
            }
            $newPerson->setChildren($children);

            if ($person->getPet() == 'no_pet') {
                $newPerson->setPetStatus('None');
            } elseif ($person->getPet() == 'in_pet') {
                $newPerson->setPetStatus('Indoor');
            } elseif ($person->getPet() == 'out_pet') {
                $newPerson->setPetStatus('Outdoor');
            } elseif ($person->getPet() == 'both_pet') {
                $newPerson->setPetStatus('Both indoor and outdoor');
            }

            $newPerson->setPetType($person->getPetType());
            $newPerson->setHobbies($person->getHobbies());
            $newPerson->setTravel($person->getTravel());
            $newPerson->setLanguages($person->getLanguages());

            if ($person->getStudentType() == 0) {
                $newPerson->setStudentType('No preference');
            } elseif ($person->getStudentType() == 1) {
                $newPerson->setStudentType('Females only');
            } elseif ($person->getStudentType() == 2) {
                $newPerson->setStudentType('Males only');
            } elseif ($person->getStudentType() == 1) {
                $newPerson->setStudentType('Married couples only');
            } else {
                $newPerson->setStudentType('No preference');
            }

            if ($person->getStudentCountry() == ' ') {
                $newPerson->setStudentCountry(null);
            } else {
                $newPerson->setStudentCountry($person->getStudentCountry());
            }

            if ($person->getMaxStudents() == "One") {
                $newPerson->setMaxStudents(1);
            } elseif ($person->getMaxStudents() == "Two") {
                $newPerson->setMaxStudents(2);
            } elseif ($person->getMaxStudents() == "Three") {
                $newPerson->setMaxStudents(3);
            } elseif ($person->getMaxStudents() == "Four") {
                $newPerson->setMaxStudents(4);
            } elseif ($person->getMaxStudents() == "Five") {
                $newPerson->setMaxStudents(5);
            } elseif ($person->getMaxStudents() == "Six") {
                $newPerson->setMaxStudents(6);
            } elseif ($person->getMaxStudents() == "More") {
                $newPerson->setMaxStudents(10);
            }

            $newPerson->setPhoto($person->getPhoto());
            $newPerson->setHosting($person->getHosting());
            $newPerson->setWivesClub($person->getWivesClub());
            $newPerson->setEventHelp($person->getEventHelp());
            $newPerson->setShopping($person->getShopping());
            $newPerson->setGroupOuting($person->getGroupOuting());
            $newPerson->setProvideMeal($person->getProvideMeal());

            $newPerson->setReferenceName($person->getReferenceName());
            $newPerson->setReferenceEmail($person->getReferenceEmail());
            $newPerson->setReferencePhone($person->getReferencePhone());
            $newPerson->setLegacyId($person->getId());

            $createdTime = strtotime($person->getSubmitTime());
            $newPerson->setCreatedAt($createdTime);
            $newPerson->setUpdatedAt($createdTime);

            $em->persist($newPerson);

            $progress->advance();
        }

        $em->flush();

        $progress->finish();

        return 'Successfully imported';
    }
}
