<?php
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        DB::table('users')->insert([
            'name' => 'admin_name',
            'email' => 'example@gmail.com',
            'password' => bcrypt('12345'),
            'remember_token' => str_random(60),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'type' => 'admin',
        ]);
        foreach (range(1,5) as $index) {
            DB::table('users')->insert([
                'name' => $faker->firstName,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('12345'),
                'remember_token' => str_random(60),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
        }
    }
}