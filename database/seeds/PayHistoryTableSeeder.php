<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PayHistoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1,50) as $index_id){
            foreach(range(1,15)as $index_amount) {
                DB::table('pay_histories')->insert([
                    'employees_id' => $index_id,
                    'amount' => $faker->numberBetween(1000,100000),
                    'created_at' => $faker->dateTimeBetween($startDate = '-7 days', $endDate = 'now'),
                    'updated_at' => $faker->dateTimeBetween($startDate = '-7 days', $endDate = 'now')
                ]);
            }
        }
    }
}
