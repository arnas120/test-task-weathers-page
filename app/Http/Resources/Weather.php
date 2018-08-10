<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Weather extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'data' => [
            'name' => $this->collection->get('name'),
            'country' => $this->collection->get('sys')['country'],
            'temp' => $this->collection->get('main')['temp'],
            'description' => $this->collection->get('weather')[0]['description'],
            ],
        ];
    }
}
