<?php

namespace App\ApiClients;


use App\Entities\General\AppEntity;
use App\Interfaces\ApiClients\ExternalAppClientInterface;
use App\Maps\General\ExternalAppTestsResponse;
use Illuminate\Support\Collection;

class ExternalAppClient implements ExternalAppClientInterface
{
    /**
     * @var AppEntity
     */
    private $appEntity;

    public function __construct(AppEntity $appEntity)
    {
        $this->appEntity = $appEntity;
    }

    /**
     * @return ExternalAppTestsResponse
     */
    public function getTests()
    {
        $response= $this->getRequest( $this->appEntity->url.'/phpunitg/getTests' , [
            'token' => $this->appEntity->token
        ]);
        return new ExternalAppTestsResponse($response);
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