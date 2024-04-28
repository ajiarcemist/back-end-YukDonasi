<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CampaignTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactions = [
            [
                'campaign_id' => 1,
                'user_id' => 1,
                'amount' => 2500000,
                'status' => 'success',
                'rejected_reason' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Omnis ratione repudiandae et expedita necessitatibus, fuga quo adipisci vero iusto magni?'
            ]
        ];
    }
}
