<?php

namespace CAIF\ManageBundle\Form\Type;

use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * @DI\Service("caif.manage.form.type.photo_album")
 * @DI\Tag("form.type", attributes={ "alias" = "caif_photo_album" })
 */
class PhotoAlbumType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text', [
            'label' => 'Album name',
        ]);

        $builder->add('description', 'textarea', [
            'label'    => 'Description (Not required)',
            'required' => false,
            'attr'     => [
                'rows' => 6,
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'CAIF\SharedBundle\Entity\PhotoAlbum',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'caif_photo_album';
    }
}
