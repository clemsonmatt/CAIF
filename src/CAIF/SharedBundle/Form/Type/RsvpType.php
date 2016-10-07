<?php

namespace CAIF\SharedBundle\Form\Type;

use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * @DI\Service("caif.shared.form.type.rsvp")
 * @DI\Tag("form.type", attributes={ "alias" = "rsvp" })
 */
class RsvpType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text', [
            'label' => 'Name',
        ]);

        $builder->add('email', 'text', [
            'label' => 'Email',
        ]);

        $builder->add('rsvpOption', 'choice', [
            'label'   => 'Are you attending?',
            'choices' => [
                'yes' => 'Yes',
                'no'  => 'No',
            ],
        ]);

        $builder->add('guestOption', 'checkbox', [
            'label'    => 'Click here to add guests',
            'mapped'   => false,
            'required' => false,
            'attr'     => [
                'class' => 'js-guest-option',
            ],
        ]);

        $builder->add('guests', 'number', [
            'label'    => 'How many guests are you bringing NOT counting yourself',
            'required' => false,
            'attr'     => [
                'class' => 'js-guest-number',
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'CAIF\SharedBundle\Entity\Rsvp',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'rsvp';
    }
}
