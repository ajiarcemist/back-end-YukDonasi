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
            'title' => $this->campaign_name,
            'location' => $this->location,
            'campaign_image_url' => Storage::url($this->campaign_image_url),
            'goal_amount' => $this->goal_amount,
            'current_amount' => $this->goal_amount - ($this->donation_sum_amount),
            'percentage_value' => ($this->donation_sum_amount/$this->goal_amount) * 100,
        ];
    }
}
