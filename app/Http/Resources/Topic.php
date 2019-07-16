<?php

namespace App\Http\Resources;

use App\Http\Resources\Speaker as SpeakerResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Topic extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'       => $this->id,
            'title'    => $this->title,
            'desc'     => $this->desc,
            'speakers' => SpeakerResource::collection($this->speakers),
        ];
    }
}
