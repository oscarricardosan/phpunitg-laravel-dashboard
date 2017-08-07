<?php

namespace App\Maps\General;


use App\Maps\BaseMapper;
use Illuminate\Support\Collection;

/**
 * @property array $tests
 */
class ExternalAppTestsResponse extends BaseMapper
{
    /**
     * @var Collection
     */
    protected $collectionTests;
    /**
     * @var array
     */
    protected $arrayTests;

    /**
     * @return Collection
     */
    public function collectionTests()
    {
        if(is_null($this->collectionTests))
            $this->collectionTests= collect($this->arrayTests());

        return $this->collectionTests;
    }

    /**
     * @return array
     */
    private function arrayTests()
    {
        if(is_null($this->arrayTests)){
            $tests= [];
            foreach ($this->tests as $test){
                $tests[]= $test->getAttributes();
            }
            $this->arrayTests= $tests;
        }
        return $this->arrayTests;
    }

    /**
     * @return array
     */
    public function getTags()
    {
        $tags= $this->collectionTests()->pluck('tag')->toArray();
        return array_unique($tags);
    }

    public function setTestsAttribute(array $rawTests)
    {
        $tests= [];
        foreach ($rawTests as &$rawTest) {
            $tests[]= new ExternalAppTestResponse($rawTest);
        }
        $this->attributes['tests']= $tests;
    }
}