<?php

namespace Database\Seeders;

use App\Models\CampaignTransaction;
use Illuminate\Database\Seeder;

class CampaignTransactionSeeder extends Seeder
{
    public function run(): void
    {

        $transactions = [
            [
                'campaign_id' => 1,
                'user_id' => 1,
                'transaction_number' => 'INV-0000001',
                'amount' => 2500000,
                'status' => 'success',
                'confirmed_date' => '2024-01-01',
                'rejected_reason' => ''
            ],
            [
                'campaign_id' => 2,
                'user_id' => 2,
                'transaction_number' => 'INV-0000002',
                'amount' => 3000000,
                'status' => 'success',
                'confirmed_date' => '2024-02-02',
                'rejected_reason' => ''
            ]
        ];


        foreach ($transactions as $transaction) {
            CampaignTransaction::create($transaction);
        }
    }
}
