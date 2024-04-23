<?php

namespace Database\Seeders;

use App\Models\Campaign as ModelsCampaign;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Campaign extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //  
        $campaigns = [
            [
                'campaign_name' => 'pembangunan jalan',
                'location' => 'yogyakarta',
                'campaign_image_url' => 'campaign/default.jpg',
                'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorem, reiciendis!',
                'goal_amount' => 10000000
            ],
            [
                'campaign_name' => 'pembangunan masjid',
                'location' => 'bali',
                'campaign_image_url' => 'campaign/default.jpg',
                'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorem, reiciendis!',
                'goal_amount' => 20000000
            ]
        ];

        foreach ($campaigns as $campaign) {
            ModelsCampaign::create($campaign);
        }
    }
}
