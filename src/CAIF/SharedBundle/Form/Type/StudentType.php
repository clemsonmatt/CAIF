<?php

namespace CAIF\SharedBundle\Form\Type;

use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use CAIF\SharedBundle\Entity\Person;
use CAIF\SharedBundle\Entity\Student;

/**
 * @DI\Service("caif.shared.form.type.student")
 * @DI\Tag("form.type", attributes={ "alias" = "student_form" })
 */
class StudentType extends PersonType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('firstName', 'text', [
            'label'    => 'First Name',
            'required' => true,
        ]);

        $builder->add('lastName', 'text', [
            'label'    => 'Last Name',
            'required' => true,
        ]);

        $builder->add('americanName', 'text', [
            'label'    => 'Do you have an American Name?',
            'required' => false,
        ]);

        $builder->add('phone', 'text', [
            'label'    => 'Phone',
            'required' => true,
        ]);

        $builder->add('email', 'text', [
            'label'    => 'Email',
            'required' => true,
        ]);

        $builder->add('email', 'repeated', [
            'type'            => 'text',
            'invalid_message' => 'The email fields must match.',
            'required'        => true,
            'first_options'   => ['label' => 'Email'],
            'second_options'  => ['label' => 'Repeat Email'],
        ]);

        $builder->add('apartmentComplex', 'text', [
            'label'    => 'Apartment Complex',
            'required' => false,
        ]);

        $builder->add('apartmentNumber', 'text', [
            'label'    => 'Apartment Number',
            'required' => false,
        ]);

        $builder->add('mailingAddress', 'text', [
            'label'    => 'Mailing Address',
            'required' => true,
        ]);

        $builder->add('city', 'text', [
            'label'    => 'City',
            'required' => true,
        ]);

        $builder->add('zip', 'text', [
            'label'    => 'Postal/Zip Code',
            'required' => true,
        ]);

        $builder->add('gender', 'choice', [
            'label'    => 'Gender',
            'choices'  => [
                'male'   => 'Male',
                'female' => 'Female',
            ],
            'required' => true,
        ]);

        $builder->add('birthday', 'date', [
            'label'    => 'Birthday (mm/dd/yyyy)',
            'years'    => range(date('Y'), date('Y') - 80),
            'widget'   => 'single_text',
            'format'   => 'MM/dd/yyyy',
            'html5'    => false,
            'required' => true,
            'attr'     => [
                'class'            => 'datepicker',
                'data-date-format' => 'mm/dd/yyyy',
            ],
        ]);

        $builder->add('homeCountry', 'choice', [
            'label'    => 'Country you are from',
            'choices'  => Person::getCountryList(false),
            'required' => true,
        ]);

        $builder->add('areaOfStudy', 'choice', [
            'label'    => 'Area Of Study',
            'choices'  => Student::getAllAreasOfStudy(),
            'required' => true,
        ]);

        $builder->add('degreeProgram', 'choice', [
            'label'    => 'Degree Program',
            'choices'  => Student::getAllDegreePrograms(),
            'required' => true,
        ]);

        $builder->add('maritalStatus', 'choice', [
            'label'    => 'Marital Status',
            'choices'  => [
                'single'  => 'Single',
                'married' => 'Married',
            ],
            'required' => true,
        ]);

        $builder->add('spouseHere', 'choice', [
            'label'   => 'Is your spouse in the U.S. with you?',
            'choices' => [
                '0' => 'No',
                '1' => 'Yes',
            ],
            'required' => true,
        ]);

        $builder->add('spouseName', 'text', [
            'label'    => 'Spouse\'s Name',
            'required' => false,
        ]);

        $builder->add('kidStatus', 'choice', [
            'label'   => 'Do you have children?',
            'choices' => [
                '0' => 'No',
                '1' => 'Yes',
            ],
            'required' => true,
        ]);

        $builder->add('kidsHere', 'choice', [
            'label'   => 'Are your children in the U.S. with you?',
            'choices' => [
                '0' => 'No',
                '1' => 'Yes',
            ],
            'required' => true,
        ]);

        $builder->add('smoke', 'choice', [
            'label'   => 'Do you smoke?',
            'choices' => [
                '0' => 'No',
                '1' => 'Yes',
            ],
            'required' => true,
        ]);

        $builder->add('car', 'choice', [
            'label'   => 'Do you have a car here you can drive?',
            'choices' => [
                '0' => 'No',
                '1' => 'Yes',
            ],
            'required' => true,
        ]);

        $builder->add('dogCatPresence', 'choice', [
            'label'   => 'Does the presence of dogs or cats make you uncomfortable?',
            'choices' => [
                '0' => 'No',
                '1' => 'Yes',
            ],
            'required' => true,
        ]);

        $builder->add('allergies', 'textarea', [
            'label'    => 'List all allergies you have',
            'attr'     => ['rows' => 3],
            'required' => false,
        ]);

        $builder->add('dneFoods', 'textarea', [
            'label'    => 'List all foods you do not eat',
            'attr'     => ['rows' => 3],
            'required' => false,
        ]);

        $builder->add('activities', 'textarea', [
            'label'    => 'List all activities you enjoy',
            'attr'     => ['rows' => 3],
            'required' => false,
        ]);

        $builder->add('languages', 'textarea', [
            'label'    => 'List all languages you speak',
            'attr'     => ['rows' => 3],
            'required' => false,
        ]);

        $builder->add('travel', 'textarea', [
            'label'    => 'List all places you have traveled',
            'attr'     => ['rows' => 3],
            'required' => false,
        ]);

        $builder->add('picture', 'file', [
            'label'    => 'If possible, could you upload a profile picture?',
            'required' => false,
            'mapped'   => false,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'CAIF\SharedBundle\Entity\Student',
        ]);

        $resolver->setRequired([
            'show_login',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'student_form';
    }
}
