<?php

namespace CAIF\SharedBundle\Twig;

use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @DI\Service("caif_shared.twig_extension")
 * @DI\Tag("twig.extension")
 */
class CAIFExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return [
            'csv' => new \Twig_Filter_Method($this, 'csvEscape'),
        ];
    }

    public function csvEscape($text)
    {
        if (! is_string($text) && ! method_exists($text, '__toString')) {
            return $text;
        }

        $search = array(
            ','
        );

        $replace = '';

        $newString = str_replace($search, $replace, (string) $text);

        return strtr(utf8_decode($newString), utf8_decode('ŠŒŽšœžŸ¥µÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ'), 'SOZsozYYuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy');
    }

    public function getName()
    {
        return 'twig_extension';
    }
}
