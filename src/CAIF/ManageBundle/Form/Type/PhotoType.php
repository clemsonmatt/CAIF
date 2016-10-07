<?php

namespace CAIF\ManageBundle\Form\Type;

use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * @DI\Service("caif.manage.form.type.photo")
 * @DI\Tag("form.type", attributes={ "alias" = "caif_photo" })
 */
class PhotoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('file', 'file', [
            'label' => 'Photo',
        ]);

        $builder->add('description', 'textarea', [
            'label'    => 'Description (Not required)',
            'required' => false,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CAIF\SharedBundle\Entity\Photo',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'caif_photo';
    }
}
