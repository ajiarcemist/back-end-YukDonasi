<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CampaignDetail extends JsonResource
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
            'title' => $this->campaign_name,
            'location' => $this->location,
            'campaign_image_url' => Storage::url($this->campaign_image_url),
            'description' => $this->description,
            'goal_amount' => $this->goal_amount,
            'current_amount' => (int) $this->donation_sum_amount ? $this->donation_sum_amount : 0,
            'precentage_value' => ($this->donation_sum_amount / $this->goal_amount) * 100,
        ];
    }
}