<?php

namespace App\apiData;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Http\Resources\Weather;

class apiData
{
    /* API call url */
    protected $apiUrl = "http://api.openweathermap.org/data/2.5/weather";


    public function getData($apiKey, $cityName) {

        $client = new Client([
            'headers' => ['content-type' => 'application/json',
            'Accept' => 'application/json'
            ]
        ]); //GuzzleHttp\Client

        /* Api call with parameters */
        $result = $client->request('GET', $this->apiUrl, [
            'query' => 
            [
                'q' => $cityName, 
                'appid' => $apiKey,
                'units' => 'metric'
            ]
        ]);
        
        // api data variable
        $data = $result->getBody();

        // put data to collection
        $dataCollection = collect(json_decode($data, true));

        // return resource api data
        return new Weather($dataCollection);
    }


}