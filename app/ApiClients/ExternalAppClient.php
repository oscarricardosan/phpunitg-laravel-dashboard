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
        return new ExternalAppTestsResponse($response['arrayResponse']);
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
        if(!array_has($response['arrayResponse'], 'success'))
            return new ResponseExternalPhpunitResponse([
                'success'=> false,
                'message'=> $response['rawResponse']
            ]);

        return new ResponseExternalPhpunitResponse($response['arrayResponse']);
    }

    protected function getRequest($url, $data)
    {
        $chanel = curl_init();
        curl_setopt($chanel, CURLOPT_URL, $url.'?'.http_build_query($data));
        curl_setopt($chanel, CURLOPT_RETURNTRANSFER, true);
        $result= curl_exec($chanel);
        curl_close($chanel);
        $decodeResponse= json_decode($result, true);
        if($decodeResponse===null){dd($result);}
        $decodeResponse= is_array($decodeResponse)?$decodeResponse:[];
        return array_merge(
            ['arrayResponse'=> $decodeResponse],
            ['rawResponse'=> $result]
        );
    }

}