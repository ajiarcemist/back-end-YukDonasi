<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_id',
        'user_id',
        'transaction_number',
        'amount',
        'status',
        'confirmed_date',
        'rejected_reason',
    ];

    protected $casts = [
        'amount' => 'integer',
    ];

    public static $statusOptions = ['pending', 'confirmed', 'rejected'];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public static function getValidationRules()
    {
        return [
            'campaign_id' => 'required|exists:campaigns,id',
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|integer|min:0',
            'status' => 'required|in:' . implode(',', self::$statusOptions),
            'confirmed_date' => 'nullable|date',
            'rejected_reason' => 'nullable|string',
        ];
    }
}
