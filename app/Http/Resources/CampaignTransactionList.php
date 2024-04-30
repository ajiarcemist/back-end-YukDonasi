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
            'id' => $this->id,
            'campaign_id' => $this->campaign_id,
            'user_id' => $this->user_id,
            'transaction_number' => $this->transaction_number,
            'amount' => $this->amount,
            'status' => $this->status,
            'confirmed_date' => $this->confirmed_date,
            'rejected_reason' => $this->rejected_reason,
        ];
    }
}
