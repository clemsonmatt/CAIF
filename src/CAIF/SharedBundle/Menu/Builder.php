<?php

namespace CAIF\SharedBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');

        $menu->addChild('Home', ['class' => 'dropdown-toggle'])
            ->setAttribute('class', 'dropdown')
            ->setChildrenAttribute('class', 'dropdown-menu');
        $menu['Home']->addChild('Home Page', ['route' => 'caif_shared_index']);
        $menu['Home']->addChild('What Folks Are Saying', ['route' => 'caif_shared_quotes']);
        $menu['Home']->addChild('Officers', ['route' => 'caif_shared_officers']);
        $menu['Home']->addChild('Photo Gallery', ['route' => 'caif_shared_gallery']);
        // $menu['Home']->addChild('Newsletters', ['uri' => '#']);

        $menu->addChild('Students', ['class' => 'dropdown-toggle'])
            ->setAttribute('class', 'dropdown')
            ->setChildrenAttribute('class', 'dropdown-menu');
        $menu['Students']->addChild('Form For New Students', ['route' => 'caif_shared_student_form']);
        $menu['Students']->addChild('Student Guidelines', ['route' => 'caif_shared_student_guidelines']);
        // $menu['Students']->addChild('Life In the U.S.', ['uri' => '#']);

        $menu->addChild('Community Members', ['uri' => '#', 'class' => 'dropdown-toggle'])
            ->setAttribute('class', 'dropdown')
            ->setChildrenAttribute('class', 'dropdown-menu');
        $menu['Community Members']->addChild('About The Program', ['route' => 'caif_shared_host_about']);
        $menu['Community Members']->addChild('Form For New Community Members', ['route' => 'caif_shared_host_form']);
        $menu['Community Members']->addChild('Community Member Guidelines', ['route' => 'caif_shared_host_guidelines']);
        $menu['Community Members']->addChild('Activity Ideas', ['route' => 'caif_shared_host_activity']);
        $menu['Community Members']->addChild('Conversation Starters', ['route' => 'caif_shared_host_conversation']);
        $menu['Community Members']->addChild('What To Serve', ['route' => 'caif_shared_host_serve']);

        $menu->addChild('Events & Services', ['uri' => '#', 'class' => 'dropdown-toggle'])
            ->setAttribute('class', 'dropdown')
            ->setChildrenAttribute('class', 'dropdown-menu');
        $menu['Events & Services']->addChild('Events', ['route' => 'caif_shared_event_index']);
        $menu['Events & Services']->addChild('English Classes', ['route' => 'caif_shared_event_english_classes']);
        $menu['Events & Services']->addChild('International Club (Bridges Int\'l)', ['route' => 'caif_shared_event_intl_club']);
        $menu['Events & Services']->addChild('International Wives Club', ['route' => 'caif_shared_event_wives_club']);

        $menu['Events & Services']->addChild('Chi Alpha Student Church', ['uri' => 'http://www.xaclemson.com/'])->setLinkAttributes(['target' => '_blank']);
        $menu['Events & Services']->addChild('Adult Learning Center', ['uri' => 'http://www.pickens.k12.sc.us/alc/pages/3.%20our%20programs/esl.aspx'])->setLinkAttributes(['target' => '_blank']);
        $menu['Events & Services']->addChild('Muslim Student Association', ['uri' => 'http://caif.dev/bundles/caifshared/images/MSA_Flyer.pdf'])->setLinkAttributes(['target' => '_blank']);
        $menu['Events & Services']->addChild('Friends of Internationals', ['uri' => 'https://www.facebook.com/groups/FriendsOfInternationals.Clemson/'])->setLinkAttributes(['target' => '_blank']);
        $menu['Events & Services']->addChild('Reformed University Fellowship Internationals', ['uri' => 'https://www.facebook.com/pages/RUF-I-Clemson/1489222417964573?fref=ts'])->setLinkAttributes(['target' => '_blank']);
        $menu['Events & Services']->addChild('Clemson Bridges International', ['uri' => 'https://www.facebook.com/groups/clemsonbridgesinternational/'])->setLinkAttributes(['target' => '_blank']);
        $menu['Events & Services']->addChild('Clemson Community Care', ['uri' => 'http://www.clemsoncommunitycare.org/'])->setLinkAttributes(['target' => '_blank']);
        $menu['Events & Services']->addChild('Buying a Used Car', ['uri' => 'https://docs.google.com/presentation/d/1A047101edGc_aDRClVG3GMki5VeQSBofhLwoXjgR6Eo/edit#slide=id.p4'])->setLinkAttributes(['target' => '_blank']);

        return $menu;
    }
}
