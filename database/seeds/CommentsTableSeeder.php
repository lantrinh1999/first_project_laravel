<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        if (DB::table('comments')->count() == 0) {
            $faker = Faker\Factory::create();
            $comments = [];
            for ($i = 0; $i < 10; ++$i) {
                $comments[] = [
                    'user_id' => random_int(1, 5),
                    'content' => $faker->realText($maxNbChars = 100, $indexSize = 2),
                    'created_at' => $faker->dateTime($max = 'now', $timezone = null),
                ];
            }
            DB::table('comments')->insert($comments);
        }
    }
}
