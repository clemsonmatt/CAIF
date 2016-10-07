<?php

namespace CAIF\ManageBundle\Form\Type;

use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * @DI\Service("caif.manage.form.type.english_class")
 * @DI\Tag("form.type", attributes={ "alias" = "english_class" })
 */
class EnglishClassType extends AbstractType
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

        $builder->add('info', 'textarea', [
            'label'    => 'Info',
            'attr'     => [
                'rows' => 6,
            ],
            'required' => true,
        ]);

        $builder->add('whatDay', 'text', [
            'label'    => 'When',
            'required' => true,
        ]);

        $builder->add('location', 'text', [
            'label'    => 'Location',
            'required' => true,
        ]);

        $builder->add('startTime', 'time', [
            'label'    => 'Start Time',
            'widget'   => 'single_text',
            'required' => true,
        ]);

        $builder->add('endTime', 'time', [
            'label'    => 'End Time',
            'widget'   => 'single_text',
            'required' => true,
        ]);

        $builder->add('food', 'textarea', [
            'label'    => 'Food',
            'attr'     => [
                'rows' => 6,
            ],
            'required' => false,
        ]);

        $builder->add('childcare', 'textarea', [
            'label'    => 'Childcare',
            'attr'     => [
                'rows' => 6,
            ],
            'required' => false,
        ]);

        $builder->add('comments', 'textarea', [
            'label'    => 'Comments',
            'attr'     => [
                'rows' => 6,
            ],
            'required' => false,
        ]);

        $builder->add('contactName', 'text', [
            'label'    => 'Contact Name',
            'required' => true,
        ]);

        $builder->add('contactPhone', 'text', [
            'label'    => 'Contact Phone',
            'required' => true,
        ]);

        $builder->add('contactEmail', 'text', [
            'label'    => 'Contact Email',
            'required' => true,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'CAIF\SharedBundle\Entity\EnglishClass',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'english_class';
    }
}
