<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->email,
            'created_at' => (string) $this->created_at->format('d/m/Y'),
            'users'  => $this->users ? $this->users->map(
                function ($user) {
                    return [
                        'id'   => $user->id,
                        'name' => $user->fullName
                    ];
                }
            ) : [],
        ];
    }
}
