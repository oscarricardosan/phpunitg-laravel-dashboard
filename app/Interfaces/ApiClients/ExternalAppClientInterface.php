<?php

namespace App\Interfaces\ApiClients;


interface ExternalAppClientInterface
{
    /**
     * @return array
     */
    public function getTests();

}