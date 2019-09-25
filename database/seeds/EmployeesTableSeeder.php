<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1,50) as $index){
            $fn = $faker->firstName;
            $ln = $faker->lastName;

            DB::table('employees')->insert([
                'firstname' => $fn,
                'lastname' => $ln,
                'dob' => $faker->date,
                'image' => 'img.jpeg',
                'contact_number' => '09' . $faker->randomNumber(9),
                'email' => strtolower($fn . '.' . $ln . '@gmail.com'),
                'balance' => '0.00',
                'created_at' => $faker->dateTimeBetween($startDate = 'now', $endDate = 'now'),
                'updated_at' => $faker->dateTimeBetween($startDate = 'now', $endDate = 'now')
            ]);
        }
    }
}
