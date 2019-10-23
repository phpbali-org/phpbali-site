<?php

namespace App\Http\Resources;

use App\Http\Resources\Reservation as ReservationResource;
use App\Http\Resources\Topic as TopicResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Event extends JsonResource
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
        if (is_null($this->resource)) {
            return [];
        }

        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'date'         => $this->eventDate(),
            'time'         => $this->eventTime(),
            'place_name'   => $this->place_name,
            'address'      => $this->address,
            'desc'         => $this->desc,
            'topics'       => TopicResource::collection($this->topics),
            'reservations' => ReservationResource::collection($this->reservations->sortByDesc('created_at')),
        ];
    }
}
