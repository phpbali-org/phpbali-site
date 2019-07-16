<?php

namespace App\Http\Resources;

use App\Http\Resources\User as UserResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class Reservation extends JsonResource
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
            'user'        => new UserResource(User::where('id', $this->user_id)->first()),
            'attended_at' => $this->attended_at,
        ];
    }
}
