<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use apiData;

class TabViewController extends Controller
{
    //

    public function showTabs() {

        // if cookie is not set return nothing
        if(!isset($_COOKIE['sessionId'])) {

            $tabsData = [];

            return view('Home', compact('tabsData'));
        }


        // user session id
        $sessionId = $_COOKIE['sessionId'];

        // get tabs data
        $tabsData = DB::table('tabs')
        ->where('token', $sessionId)
        ->orderBy('id', 'ASC')
        ->get();

        return view('Home', compact('tabsData'));
    }

    public function showTabData($cityName) {

        // user session id
        $sessionId = $_COOKIE['sessionId'];

        // get tab api key by sessionid
        // and city name
        $tabKey = DB::table('tabs')
        ->where('token', $sessionId)
        ->where('city', $cityName)
        ->select('api_key')
        ->limit(1)
        ->get();

        $apiKey = $tabKey[0]->api_key; //tab api key

        // get weather data from api
        $weatherData = apiData::getData($apiKey, $cityName);

        return $weatherData;
    }

}
