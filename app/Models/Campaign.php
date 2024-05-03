<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;
    protected $fillable = ['campaign_name', 'location', 'campaign_image_url', 'description', 'goal_amount'];

    public function donation() {
        return $this->hasMany(CampaignTransaction::class, 'campaign_id', 'id')->where('status', 'success');
    }
}
