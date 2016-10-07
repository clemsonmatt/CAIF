<?php

namespace CAIF\ManageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{
    protected function sortHostByLastName(array $hosts)
    {
        $hostsWithKey = [];
        $sortedHosts  = [];

        /* first put last name as key */
        foreach ($hosts as $host) {
            $hostsWithKey[$host->getLastName().''.$host->getId()] = $host;
        }

        /* sort */
        ksort($hostsWithKey);

        /* 'keyless' array of sorted hosts */
        foreach ($hostsWithKey as $lastName => $host) {
            $sortedHosts[] = $host;
        }

        return $sortedHosts;
    }
}
