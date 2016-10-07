<?php

namespace CAIF\ManageBundle\Form\Type;

use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * @DI\Service("caif.manage.form.type.event")
 * @DI\Tag("form.type", attributes={ "alias" = "event" })
 */
class EventType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text', [
            'label'    => 'Title',
            'required' => true,
        ]);

        $builder->add('description', 'textarea', [
            'label'    => 'Description',
            'attr'     => [
                'rows' => 16,
            ],
            'required' => true,
        ]);

        $builder->add('location', 'text', [
            'label'    => 'Location',
            'required' => true,
        ]);

        $builder->add('startDate', 'date', [
            'label'    => 'Start Date',
            'widget'   => 'single_text',
            'format'   => 'MM/dd/yyyy',
            'html5'    => false,
            'required' => true,
            'attr'     => [
                'class'            => 'datepicker',
                'data-date-format' => 'mm/dd/yyyy',
            ],
        ]);

        $builder->add('endDate', 'date', [
            'label'    => 'End Date',
            'widget'   => 'single_text',
            'format'   => 'MM/dd/yyyy',
            'html5'    => false,
            'required' => true,
            'attr'     => [
                'class'            => 'datepicker',
                'data-date-format' => 'mm/dd/yyyy',
            ],
        ]);

        $builder->add('startTime', 'text', [
            'label'    => 'Start Time',
            'required' => true,
            'attr'     => [
                'class' => 'timepicker',
            ],
        ]);

        $builder->add('endTime', 'text', [
            'label'    => 'End Time',
            'required' => true,
            'attr'     => [
                'class' => 'timepicker',
            ],
        ]);

        $builder->add('rsvp', 'checkbox', [
            'label'    => 'RSVP',
            'required' => false,
        ]);

        $builder->add('recurring', 'checkbox', [
            'label'    => 'Recurring',
            'required' => false,
        ]);

        $builder->add('contact_name', 'text', [
            'label'    => 'Contact Name',
            'required' => false,
        ]);

        $builder->add('contact_phone', 'text', [
            'label'    => 'Contact Phone',
            'required' => false,
        ]);

        $builder->add('contact_email', 'text', [
            'label'    => 'Contact Email',
            'required' => false,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'CAIF\SharedBundle\Entity\Event',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'event';
    }
}
