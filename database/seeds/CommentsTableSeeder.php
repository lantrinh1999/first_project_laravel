<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('comments')->count() == 0) {
            
            $faker = Faker\Factory::create();
            $comments = [];
            for ($i = 0; $i < 5; ++$i) {
                $comments[] = [
                    'user_id' => $i,
                    'content' => $faker->realText($maxNbChars = 100, $indexSize = 2),
                    'created_at' => $faker->dateTime($max = 'now', $timezone = null),
                ];
            }
            DB::table('comments')->insert($comments);
        }
    }
}
