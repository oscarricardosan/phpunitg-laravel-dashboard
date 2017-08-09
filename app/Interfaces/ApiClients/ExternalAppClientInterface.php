<?php

namespace App\Interfaces\ApiClients;


use App\Entities\General\AppEntity;
use App\Entities\General\MethodEntity;
use App\Maps\General\ExternalAppTestsResponse;
use App\Maps\General\ResponseExternalPhpunitResponse;

interface ExternalAppClientInterface
{
    /**
     * @return ExternalAppTestsResponse
     */
    public function getTests(AppEntity $appEntity);

    /**
     * @return ResponseExternalPhpunitResponse
     */
    public function runMethod(MethodEntity $methodEntity);

}