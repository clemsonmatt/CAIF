<?php

namespace CAIF\SharedBundle\Form\Type;

use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @DI\Service("caif.shared.form.type.change_password")
 * @DI\Tag("form.type", attributes={ "alias" = "change_password" })
 */
class PasswordType extends AbstractType
{
    public function buildForm (FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('oldPassword', 'password', [
                'label' => 'Current Password',
                'attr'  => ['class' => 'form-control']
            ])

            ->add('newPassword', 'repeated', [
                'type'           => 'password',
                'first_options'  => ['label' => 'New Password'],
                'second_options' => ['label' => 'Repeat Password']
            ]);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'CAIF\SharedBundle\Form\Model\ChangePassword',
        ]);
    }

    public function getName()
    {
        return 'change_password';
    }
}
