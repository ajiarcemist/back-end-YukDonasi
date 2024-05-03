<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserProfile extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'avatar_img_url' => Storage::url($this->avatar_img_url),
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'total_donation' => $this->total_donation,
            'registered_date' => $this->created_at,
            'status' => $this->status,
        ];
    }
}
