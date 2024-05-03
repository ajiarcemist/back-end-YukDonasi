<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CampaignTransactionDetail extends JsonResource
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
            'status' => $this->status,
            'amount' => $this->amount,
            'confirmed_date' => $this->confirmed_date,
            'campaign_name' => $this->campaign->title,
            'transacton_id' => $this->transaction_number,
            'date' => $this->confirmed_date,
            'rejected_reason' => $this->rejected_reason,
        ];
    }
}
