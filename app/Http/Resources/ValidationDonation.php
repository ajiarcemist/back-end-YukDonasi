<?php

namespace App\Http\Resources;

class ValidationDonation
{
    public static function donationRules(): array
    {
        return [
            'campaign_id' => 'required|exists:campaigns,id',
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'status' => 'nullable|in:pending,success,rejected',
            'confirmed_date' => 'nullable|date',
            'rejected_reason' => 'nullable|string',
        ];
    }
}
