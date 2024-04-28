<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CampaignListResource extends JsonResource
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
            'campaign_name' => $this->campaign_name,
            'location' => $this->location,
            'campaign_image_url' => Storage::url($this->campaign_image_url),
            'description' => $this->description,
            'goal_amount' => $this->goal_amount,
        ];
    }
}