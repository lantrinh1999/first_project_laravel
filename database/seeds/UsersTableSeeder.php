<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        if (DB::table('users')->count() == 0) {
            $faker = Faker\Factory::create();
            $users = [];
            for ($i = 0; $i < 10; ++$i) {
                $users[] = [
                    'name' => $faker->name,
                    'email' => 'admin'.$i.'@gmail.com',
                    'password' => bcrypt('123456'),
                    'created_at' => $faker->dateTime($max = 'now', $timezone = null),
                ];
            }
            DB::table('users')->insert($users);
        }
    }
}
