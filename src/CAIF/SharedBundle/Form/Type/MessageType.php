<?php

namespace CAIF\SharedBundle\Form\Type;

use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use CAIF\SharedBundle\Entity\Message;

/**
 * @DI\Service("caif.shared.form.type.message")
 * @DI\Tag("form.type", attributes={ "alias" = "message" })
 */
class MessageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('userId', 'hidden', [
            'required' => false,
        ]);

        $builder->add('name', 'text', [
            'label'    => 'Name',
            'required' => true,
        ]);

        $builder->add('email', 'text', [
            'label'    => 'Email',
            'required' => true,
        ]);

        $builder->add('affiliation', 'choice', [
            'label'    => 'Affiliation with Clemson University',
            'choices'  => Message::getAllAffiliations(),
            'required' => true,
        ]);

        $builder->add('pertains', 'choice', [
            'label'    => 'Question pertains to:',
            'choices'  => Message::getAllPertainsTo(),
            'required' => true,
        ]);

        $builder->add('message', 'textarea', [
            'label'    => 'Question/Comments',
            'required' => true,
            'attr'     => [
                'rows' => 5,
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'CAIF\SharedBundle\Entity\Message',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'message';
    }
}
