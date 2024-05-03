<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CampaignTransactionList extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->campaign->title,
            'location' => $this->campaign->location,
            'campaign_img_url' => $this->campaign->campaign_img_url,
            'status' => $this->status,
        ];
    }
}
