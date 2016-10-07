<?php

namespace CAIF\SharedBundle\Form\Type;

use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @DI\Service("caif.shared.form.type.forgot_password")
 * @DI\Tag("form.type", attributes={ "alias" = "forgot_password" })
 */
class ForgotPasswordType extends AbstractType
{
    public function buildForm (FormBuilderInterface $builder, array $options)
    {
        $builder->add('newPassword', 'repeated', [
            'type' => 'password',
            'first_options'  => ['label' => 'New Password'],
            'second_options' => ['label' => 'Repeat Password']
        ]);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'CAIF\SharedBundle\Form\Model\ForgotPassword',
        ]);
    }

    public function getName()
    {
        return 'forgot_password';
    }
}
