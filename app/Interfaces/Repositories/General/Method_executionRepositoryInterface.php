<?php

namespace App\Interfaces\Repositories\General;


use App\Entities\General\MethodEntity;
use App\Interfaces\Repositories\BaseRepositoryInterface;
use App\Maps\General\ResponseExternalPhpunitResponse;

interface Method_executionRepositoryInterface extends BaseRepositoryInterface
{

    /**
     * @return $this
     */
    public function storeExternalResponse(ResponseExternalPhpunitResponse $response);

    /**
     * @param MethodEntity $methodEntity
     * @return $this
     */
    public function setMethodEntity(MethodEntity $methodEntity);
}