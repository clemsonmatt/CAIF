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
        $menu['About']->addChild('Who We Are', ['route' => 'caif_shared_testimonials']);
        $menu['About']->addChild('Our Mission', ['route' => 'caif_shared_testimonials']);
        $menu['About']->addChild('Testimonials', ['route' => 'caif_shared_testimonials']);
        $menu['About']->addChild('Photos', ['route' => 'caif_shared_gallery']);
        $menu['About']->addChild('Board Members', ['route' => 'caif_shared_officers']);

        $menu->addChild('Host Home Program', ['class' => 'dropdown-toggle'])
            ->setAttribute('class', 'dropdown')
            ->setChildrenAttribute('class', 'dropdown-menu');
        $menu['Host Home Program']->addChild('About The Program', ['route' => 'caif_shared_host_about']);
        $menu['Host Home Program']->addChild('Student Guidelines', ['route' => 'caif_shared_student_guidelines']);
        $menu['Host Home Program']->addChild('Form For New Students', ['route' => 'caif_shared_student_form']);
        $menu['Host Home Program']->addChild('Intro to Hosting Students', ['route' => 'caif_shared_host_conversation']);
        $menu['Host Home Program']->addChild('Host Guidelines', ['route' => 'caif_shared_host_guidelines']);
        $menu['Host Home Program']->addChild('Form For New Hosts', ['route' => 'caif_shared_host_form']);

        $menu->addChild('Upcoming Events', ['uri' => '#', 'class' => 'dropdown-toggle'])
            ->setAttribute('class', 'dropdown')
            ->setChildrenAttribute('class', 'dropdown-menu');
        $menu['Upcoming Events']->addChild('Current Events', ['route' => 'caif_shared_event_index']);
        $menu['Upcoming Events']->addChild('International Club (Bridges Int\'l)', ['route' => 'caif_shared_event_intl_club']);
        $menu['Upcoming Events']->addChild('International Wives Club', ['route' => 'caif_shared_event_wives_club']);

        $menu->addChild('Helpful Resources', ['uri' => '#', 'class' => 'dropdown-toggle'])
            ->setAttribute('class', 'dropdown')
            ->setChildrenAttribute('class', 'dropdown-menu');
        $menu['Helpful Resources']->addChild('Adult Learning Center', ['uri' => 'http://www.pickens.k12.sc.us/alc/pages/3.%20our%20programs/esl.aspx'])->setLinkAttributes(['target' => '_blank']);
        $menu['Helpful Resources']->addChild('Clemson Community Care', ['uri' => 'http://www.clemsoncommunitycare.org/'])->setLinkAttributes(['target' => '_blank']);
        $menu['Helpful Resources']->addChild('Buying a Used Car', ['uri' => 'https://docs.google.com/presentation/d/1A047101edGc_aDRClVG3GMki5VeQSBofhLwoXjgR6Eo/edit#slide=id.p4'])->setLinkAttributes(['target' => '_blank']);
        $menu['Helpful Resources']->addChild('English Classes', ['route' => 'caif_shared_event_english_classes']);
        $menu['Helpful Resources']->addChild('When In Clemson', ['uri' => 'http://www.xaclemson.com/'])->setLinkAttributes(['target' => '_blank']);
        $menu['Helpful Resources']->addChild('International Services Clemson', ['uri' => 'http://caif.dev/bundles/caifshared/images/MSA_Flyer.pdf'])->setLinkAttributes(['target' => '_blank']);

        $menu->addChild('Alumni', ['uri' => '#', 'class' => 'dropdown-toggle'])
            ->setAttribute('class', 'dropdown')
            ->setChildrenAttribute('class', 'dropdown-menu');
        $menu['Alumni']->addChild('About', ['uri' => '#']);
        $menu['Alumni']->addChild('Ways To Give Back', ['uri' => '#']);

        return $menu;
    }
}
