<?php

namespace App\ApiClients;


use App\Entities\General\AppEntity;
use App\Entities\General\MethodEntity;
use App\Interfaces\ApiClients\ExternalAppClientInterface;
use App\Maps\General\ExternalAppTestsResponse;
use App\Maps\General\ResponseExternalPhpunitResponse;
use Illuminate\Support\Collection;

class ExternalAppClient implements ExternalAppClientInterface
{

    /**
     * @return ExternalAppTestsResponse
     */
    public function getTests(AppEntity $appEntity)
    {
        $response= $this->getRequest( $appEntity->url.'/phpunitg/getTests' , [
            'token' => $appEntity->token
        ]);
        return new ExternalAppTestsResponse($response);
    }

    /**
     * @return ResponseExternalPhpunitResponse
     */
    public function runMethod(MethodEntity $methodEntity)
    {
        $app= $methodEntity->test->tag->app;
        $response= $this->getRequest( $app->url.'/phpunitg/runMethod' , [
            'token' => $app->token,
            'method' => $methodEntity->test->class.'::'.$methodEntity->name,
        ]);
        return new ResponseExternalPhpunitResponse($response);
    }

    protected function getRequest($url, $data)
    {
        $chanel = curl_init();
        curl_setopt($chanel, CURLOPT_URL, $url.'?'.http_build_query($data));
        curl_setopt($chanel, CURLOPT_RETURNTRANSFER, true);
        $result= curl_exec($chanel);
        //dd($result);
        curl_close($chanel);
        return json_decode($result, true);
    }

}