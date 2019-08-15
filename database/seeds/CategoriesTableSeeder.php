<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        if (DB::table('categories')->count() == 0) {
            $faker = Faker\Factory::create();
            $categories = [];
            for ($i = 0; $i < 10; ++$i) {
                $categories[] = [
                    'name' => $faker->name,
                    'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                    'parent_id' => 0,
                    'created_at' => $faker->dateTime($max = 'now', $timezone = null),
                ];
            }
            DB::table('categories')->insert($categories);
        }
    }
}
