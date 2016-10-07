<?php

namespace CAIF\SharedBundle\Form\Type;

use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use CAIF\SharedBundle\Entity\Host;
use CAIF\SharedBundle\Entity\Person;

/**
 * @DI\Service("caif.shared.form.type.host")
 * @DI\Tag("form.type", attributes={ "alias" = "host_form" })
 */
class HostType extends PersonType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('name', 'text', [
            'label'    => 'Name',
            'required' => true,
        ]);

        $builder->add('mobilePhone', 'text', [
            'label'    => 'Mobile Phone',
            'required' => false,
        ]);

        $builder->add('homePhone', 'text', [
            'label'    => 'Home Phone',
            'required' => false,
        ]);

        $builder->add('workPhone', 'text', [
            'label'    => 'Work Phone',
            'required' => false,
        ]);

        $builder->add('email', 'text', [
            'label'    => 'Email',
            'required' => false,
        ]);

        $builder->add('secondaryEmail', 'text', [
            'label'    => 'Second email (optional)',
            'required' => false,
        ]);

        $builder->add('address', 'text', [
            'label'    => 'Address',
            'required' => true,
        ]);

        $builder->add('city', 'text', [
            'label'    => 'City',
            'required' => true,
        ]);

        $builder->add('state', 'choice', [
            'label'    => 'State',
            'required' => true,
            'choices'  => Host::getStatesList(),
        ]);

        $builder->add('zip', 'text', [
            'label'    => 'Postal/Zip Code',
            'required' => true,
        ]);

        $builder->add('children', 'choice', [
            'label'    => 'Do you have children?',
            'required' => true,
            'choices'  => [
                'None'    => 'No',
                'Small'   => 'Yes, we have young children',
                'Teenage' => 'Yes, we have teenage children',
                'College' => 'Yes, we have college age children',
                'Grown'   => 'Yes, but they are grown and do not live with us now',
            ],
            'expanded' => true,
            'multiple' => true,
        ]);

        $builder->add('petStatus', 'choice', [
            'label'    => 'Do you have pets?',
            'required' => true,
            'choices'  => [
                'None'                    => 'No',
                'Indoor'                  => 'Yes, indoor only',
                'Outdoor'                 => 'Yes, outdoor only',
                'Both indoor and outdoor' => 'Yes, both indoor and outdoor',
            ],
            'expanded' => true,
            'multiple' => false,
        ]);

        $builder->add('petType', 'textarea', [
            'label'    => 'What kind of pets do you have?',
            'required' => false,
            'attr'     => ['rows' => 3],
        ]);

        $builder->add('hobbies', 'textarea', [
            'label'    => 'Please list your interest and hobbies',
            'required' => false,
            'attr'     => ['rows' => 3],
        ]);

        $builder->add('travel', 'textarea', [
            'label'    => 'Where have you traveled?',
            'required' => false,
            'attr'     => ['rows' => 3],
        ]);

        $builder->add('languages', 'textarea', [
            'label'    => 'What languages do you know?',
            'required' => false,
            'attr'     => ['rows' => 3],
        ]);

        $builder->add('picture', 'file', [
            'label'    => 'If possible, could you upload a family picture?',
            'required' => false,
            'mapped'   => false,
        ]);

        $builder->add('hosting', 'choice', [
            'label'    => 'Host Friend Program Involvement',
            'required' => true,
            'choices'  => [
                '0' => 'I am unable to host students this year',
                '1' => 'I am willing to host students this year',
            ],
            'expanded' => true,
            'multiple' => false,
        ]);

        $builder->add('studentType', 'choice', [
            'label'    => 'Student Preference',
            'required' => true,
            'choices'  => [
                'No preference'        => 'No preference',
                'Females only'         => 'Females only',
                'Males only'           => 'Males only',
                'Married couples only' => 'Married couples only',
            ],
        ]);

        $builder->add('studentCountry', 'choice', [
            'label'    => 'Country Preference',
            'required' => true,
            'choices'  => Person::getCountryList(),
        ]);

        $builder->add('maxStudents', 'choice', [
            'label'    => 'How many students would you be willing to host?',
            'required' => true,
            'choices'  => [
                '1'  => 'One',
                '2'  => 'Two',
                '3'  => 'Three',
                '4'  => 'Four',
                '5'  => 'Five',
                '6'  => 'Six',
                '7'  => 'Seven',
                '8'  => 'Eight',
                '10' => 'More',
            ],
        ]);

        $builder->add('wivesClub', 'checkbox', [
            'label'    => 'International Wives Club',
            'required' => false,
        ]);

        $builder->add('eventHelp', 'checkbox', [
            'label'    => 'Event set-up / clean-up',
            'required' => false,
        ]);

        $builder->add('shopping', 'checkbox', [
            'label'    => 'Organize shopping trips',
            'required' => false,
        ]);

        $builder->add('groupOuting', 'checkbox', [
            'label'    => 'Organize a group outing opportunity',
            'required' => false,
        ]);

        $builder->add('provideMeal', 'checkbox', [
            'label'    => 'Provide a meal for an international family to help welcome a new baby',
            'required' => false,
        ]);

        if ($options['show_reference']) {
            $builder->add('referenceName', 'text', [
                'label'    => 'Reference Name',
                'required' => true,
            ]);

            $builder->add('referencePhone', 'text', [
                'label'    => 'Reference Phone',
                'required' => true,
            ]);

            $builder->add('referenceEmail', 'text', [
                'label'    => 'Reference Email',
                'required' => true,
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'CAIF\SharedBundle\Entity\Host',
        ]);

        $resolver->setRequired([
            'show_login',
            'show_reference',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'host_form';
    }
}
