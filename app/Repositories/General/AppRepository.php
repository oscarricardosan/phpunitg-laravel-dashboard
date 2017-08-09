<?php

namespace App\Repositories\General;


use App\ApiClients\ExternalAppClient;
use App\Entities\General\AppEntity;
use App\Interfaces\Repositories\General\AppRepositoryInterface;
use App\Interfaces\Repositories\General\MethodRepositoryInterface;
use App\Interfaces\Repositories\General\TagRepositoryInterface;
use App\Interfaces\Repositories\General\TestRepositoryInterface;
use App\Maps\General\ExternalAppTestsResponse;
use App\Maps\General\StoreAppMap;
use App\Objects\System\CacheObject;
use App\Repositories\BaseRepository;
use Doctrine\DBAL\Schema\Schema;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class AppRepository extends BaseRepository implements AppRepositoryInterface
{
    /**
     * @var TagRepositoryInterface
     */
    protected $tagRepository;

    /**
     * @var TestRepositoryInterface
     */
    protected $testRepository;

    /**
     * @var MethodRepositoryInterface
     */
    protected $methodRepository;

    /**
     * @var CacheObject
     */
    protected $cache;

    /**
     * @var ExternalAppTestsResponse
     */
    protected $responseExternalTests;

    public function __construct($entity = null)
    {
        $this->tagRepository= App::make(TagRepositoryInterface::class);
        $this->testRepository= App::make(TestRepositoryInterface::class);
        $this->methodRepository= App::make(MethodRepositoryInterface::class);

        $this->cache= new CacheObject();
        parent::__construct($entity);
    }

    /**
     * @return AppEntity
     */
    public function getNewEntity()
    {
        return new AppEntity();
    }

    /**
     * @return $this
     */
    public function store(StoreAppMap $storeMap)
    {
        $this->setNewEntity();
        $this->fillFromMap($storeMap);
        $this->getEntity()->token= str_random(10);
        $this->getEntity()->save();
        return $this;
    }

    /**
     * @return $this
     */
    public function cleanAppTables()
    {
        $this->getEntity()->tags()->delete();
        return $this;
    }

    /**
     * @return $this
     */
    public function storeTestsOfExternalApp()
    {
        $this->getTestsOfExternalApp()
            ->storeTags()
            ->storeTestsAndMethods();

        return $this;
    }

    /**
     * @return $this
     */
    protected function getTestsOfExternalApp()
    {
        $appClient= new ExternalAppClient();
        $this->responseExternalTests= $appClient->getTests($this->getEntity());
        return $this;
    }

    /**
     * @return $this
     */
    protected function storeTags()
    {
        foreach($this->responseExternalTests->getTags() as $tagName){
            $this->tagRepository->setAppEntity($this->getEntity())->store($tagName);
            $this->cache->set('TAG_'.$tagName ,$this->tagRepository->getEntity());
        }
        return $this;
    }

    /**
     * @return $this
     */
    protected function storeTestsAndMethods()
    {
        foreach ($this->responseExternalTests->tests as $test){
            $this->testRepository
                ->setTagEntity($this->cache->get('TAG_'.$test->tag))
                ->store($test->class, $test->path);

            foreach($test->methods as $method){
                $this->methodRepository
                    ->setTestEntity($this->testRepository->getEntity())
                    ->store($method);
            }
        }
        return $this;
    }
}