<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\WorkImage as WorkImageResource;

class Work extends JsonResource
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
            'id' => $this->id,
            'main_img' => $this->main_img,
            'title' => $this->title,
            'detail' => $this->detail,
            'images' => WorkImageResource::collection($this->images),
            'iframe1' => $this->iframe1,
            'iframe2' => $this->iframe2,
            'created_at' => (string)$this->created_at,
            'updated_at' => (string)$this->updated_at,
        ];
    }
}
