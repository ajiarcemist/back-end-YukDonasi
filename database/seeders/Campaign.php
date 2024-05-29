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
                'campaign_name' => 'Pembangunan Jalan',
                'location' => 'Yogyakarta',
                'campaign_image_url' => 'campaign/highway.jpg',
                'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorem, reiciendis!',
                'goal_amount' => 100000000,
            ],
            [
                'campaign_name' => 'Pembangunan Masjid',
                'location' => 'Bali',
                'campaign_image_url' => 'campaign/cardImg.png',
                'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorem, reiciendis!',
                'goal_amount' => 200000000,
            ],
            [
                'campaign_name' => 'Pembangunan Sekolah',
                'location' => 'bali',
                'campaign_image_url' => 'campaign/sekolah.jpeg',
                'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorem, reiciendis!',
                'goal_amount' => 200000000,
            ]
        ];

        foreach ($campaigns as $campaign) {
            ModelsCampaign::create($campaign);
        }
    }
}
