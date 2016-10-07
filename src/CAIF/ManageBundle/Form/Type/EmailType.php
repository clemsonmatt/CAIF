<?php

namespace CAIF\ManageBundle\Form\Type;

use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use CAIF\SharedBundle\Entity\Email;

/**
 * @DI\Service("caif.manage.form.type.email")
 * @DI\Tag("form.type", attributes={ "alias" = "email" })
 */
class EmailType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('to', 'choice', [
            'choices'  => Email::toList($options['event']),
            'multiple' => false,
            'expanded' => true,
        ]);

        $builder->add('subject', 'text');

        $builder->add('message', 'textarea', [
            'attr' => ['rows' => 20],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'CAIF\SharedBundle\Entity\Email',
        ]);

        $resolver->setRequired([
            'event',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'email';
    }
}
