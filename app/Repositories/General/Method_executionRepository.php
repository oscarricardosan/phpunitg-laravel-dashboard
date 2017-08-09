<?php

namespace App\Repositories\General;


use App\ApiClients\ExternalAppClient;
use App\Entities\BaseEntity;
use App\Entities\General\Method_executionEntity;
use App\Entities\General\MethodEntity;
use App\Interfaces\Repositories\General\Method_executionRepositoryInterface;
use App\Maps\General\ResponseExternalPhpunitResponse;
use App\Repositories\BaseRepository;

class Method_executionRepository extends BaseRepository implements Method_executionRepositoryInterface
{
    /**
     * @var MethodEntity
     */
    protected $methodEntity;

    /**
     * @return Method_executionEntity
     */
    public function getNewEntity()
    {
        return new Method_executionEntity();
    }

    /**
     * @return $this
     */
    public function storeExternalResponse(ResponseExternalPhpunitResponse $response)
    {
        $this->setNewEntity();
        $this->getEntity()->success= $response->success;
        $this->getEntity()->method_id= $this->methodEntity->id;
        $this->getEntity()->message= $response->message;
        $this->getEntity()->save();
        return $this;
    }

    /**
     * @param MethodEntity $methodEntity
     * @return $this
     */
    public function setMethodEntity(MethodEntity $methodEntity)
    {
        $this->methodEntity= $methodEntity;
        return $this;
    }
}