<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        if (DB::table('products')->count() == 0) {
            $posts = [];
            $faker = Faker\Factory::create();
            for ($i = 0; $i < 30; ++$i) {
                $posts[] = [
                    'name' => $faker->name,
                    'price' => $faker->numberBetween(100000, 500000),
                    'image' => 'https://i.imgur.com/c2f4JUB.png',
                    'status' => $faker->numberBetween(1, 2),
                    'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                    'created_at' => $faker->dateTime($max = 'now', $timezone = null),
               ];
            }
            DB::table('products')->insert($posts);
        }
    }
}
