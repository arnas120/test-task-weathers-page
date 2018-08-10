<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddTabController extends Controller
{

    /**
     * Add new tab.
     *
     * @param  Request  $request
     * @return Response
     */

    public function processForm(Request $request) {

        $validatedData = $request->validate([
            'apiKey' => 'required',
            'cityName' => 'required',
        ]);

        // form data is valid - proceed

            // variables for database
                $sessionId = $_COOKIE['sessionId'];
                $cityName = $request->cityName;
                $apiKey = $request->apiKey;


        // store record to database    
            DB::table('tabs')->insert(
                [
                    'token' => $sessionId, 
                    'city' => $cityName,
                    'api_key' => $apiKey,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ); 

        return $request->all();       
    }

}
