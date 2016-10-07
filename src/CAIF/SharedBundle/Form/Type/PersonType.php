<?php

namespace CAIF\SharedBundle\Form\Type;

use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * @DI\Service("caif.shared.form.type.person")
 * @DI\Tag("form.type", attributes={ "alias" = "person_form" })
 */
class PersonType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($options['show_login'] === true) {
            $builder->add('username', 'text', [
                'label'    => 'Username',
                'required' => true,
            ]);

            $builder->add('password', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'The password fields must match.',
                'options' => array('attr' => array('class' => 'password-field')),
                'required' => true,
                'first_options'  => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat Password'),
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class'         => 'CAIF\SharedBundle\Entity\Person',
            'cascade_validation' => true,
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
        return 'person_form';
    }
}
