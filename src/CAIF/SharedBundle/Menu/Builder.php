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

        $menu->addChild('About', ['class' => 'dropdown-toggle'])
            ->setAttribute('class', 'dropdown')
            ->setChildrenAttribute('class', 'dropdown-menu');
        $menu['About']->addChild('Who We Are', ['route' => 'caif_shared_about']);
        $menu['About']->addChild('Mission', ['route' => 'caif_shared_mission']);
        $menu['About']->addChild('Upcoming Events', ['uri' => 'https://www.facebook.com/groups/ClemsonAreaInternationalFriendship/'])->setLinkAttributes(['target' => '_blank']);

        $menu->addChild('Host Program', ['class' => 'dropdown-toggle'])
        ->setAttribute('class', 'dropdown')
        ->setChildrenAttribute('class', 'dropdown-menu');
        $menu['Host Program']->addChild('Intro to Hosting Students', ['route' => 'caif_shared_host_conversation']);
        $menu['Host Program']->addChild('Host Guidelines', ['route' => 'caif_shared_host_guidelines']);
        $menu['Host Program']->addChild('Form For New Hosts', ['route' => 'caif_shared_host_form']);

        $menu->addChild('Student Program', ['class' => 'dropdown-toggle'])
        ->setAttribute('class', 'dropdown')
        ->setChildrenAttribute('class', 'dropdown-menu');
        $menu['Student Program']->addChild('Student Guidelines', ['route' => 'caif_shared_student_guidelines']);
        $menu['Student Program']->addChild('Testimonials', ['route' => 'caif_shared_testimonials']);
        $menu['Student Program']->addChild('Form For New Students', ['route' => 'caif_shared_student_form']);

        $menu->addChild('Helpful Resources', ['uri' => '#', 'class' => 'dropdown-toggle'])
            ->setAttribute('class', 'dropdown')
            ->setChildrenAttribute('class', 'dropdown-menu');
        $menu['Helpful Resources']->addChild('International Club (Bridges Int\'l)', ['route' => 'caif_shared_event_intl_club']);
        $menu['Helpful Resources']->addChild('International Wives Club', ['route' => 'caif_shared_event_wives_club']);
        $menu['Helpful Resources']->addChild('Clemson Community Care', ['uri' => 'http://www.clemsoncommunitycare.org/'])->setLinkAttributes(['target' => '_blank']);
        $menu['Helpful Resources']->addChild('Buying a Used Car', ['uri' => 'https://docs.google.com/presentation/d/1A047101edGc_aDRClVG3GMki5VeQSBofhLwoXjgR6Eo/edit#slide=id.p4'])->setLinkAttributes(['target' => '_blank']);
        $menu['Helpful Resources']->addChild('English Classes', ['route' => 'caif_shared_event_english_classes']);
        $menu['Helpful Resources']->addChild('FAQ', ['route' => 'caif_shared_faq']);

        return $menu;
    }
}
