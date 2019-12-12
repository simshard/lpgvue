<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;


class Post extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       // return parent::toArray($request);
        return [
        'id' => $this->id,
        'title' =>  $this->title,
        'body' => $this->body,
        ];
    }
    public function with($request)
    {
        return [
            'version' => '1.0.0',
            'api_url' => url('http://lpgvue.test/api'),
            //'fnord'   =>'♫'
        ];
    }
}
