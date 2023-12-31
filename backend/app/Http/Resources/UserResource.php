<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'email'      => $this->email,
            'first_name' => $this->profile->first_name ?? null,
            'last_name'  =>  $this->profile->last_name ?? null,
            'phone'      =>  $this->profile->phone ?? null,
            'address'    => $this->profile->address ?? null,
            'created_at' => (string) $this->created_at->format('d/m/Y'),
            'groupe'    => $this->groupe->id ?? null,

        ];

    }
}
