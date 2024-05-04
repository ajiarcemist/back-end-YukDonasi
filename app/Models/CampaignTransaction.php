<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignTransaction extends Model
{
    use HasFactory;
    protected $fillable = ['campaign_id', 'user_id', 'transaction_number', 'amount', 'status', 'confirmed_date', 'rejected_reason'];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
