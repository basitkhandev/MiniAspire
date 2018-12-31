<?php

use Illuminate\Database\Seeder;

class AspirSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\IntrestRate::insert([
            'interest_rate_name' => 'Basic interest',
            'interest_ratio' => 2
        ]);

        \App\ArrangmentFee::insert([
            'arrangement_fee_name' => 'Basic Arrangement Fee',
            'fee' => 100
        ]);

        \App\RepaymentFrequency::insert([
            'frequency_name' => 'Monthly'
        ]);
        \App\RepaymentFrequency::insert([
            'frequency_name' => 'Quarterly'
        ]);
        \App\RepaymentFrequency::insert([
            'frequency_name' => 'Semi Annually'
        ]);
        \App\RepaymentFrequency::insert([
            'frequency_name' => 'Annually'
        ]);
    }
}
