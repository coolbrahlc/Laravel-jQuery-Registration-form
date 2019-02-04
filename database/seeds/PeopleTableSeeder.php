<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();

        foreach (range(1,80) as $index) {

            DB::table('people')->insert([

                'name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->unique()->safeEmail,
                'birth' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'country' => $faker->countryCode,
                'subject' => $faker->word,
                'phone' => $faker->phoneNumber,

                'photo'=> array_random([rand(0,9).".jpg", null]),
                'about' => $faker->realText($faker->numberBetween(10,20)),
                'company' => $faker->word,
                'position' => $faker->word,
                'hidden' => rand(0,1),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
        }
    }

}
