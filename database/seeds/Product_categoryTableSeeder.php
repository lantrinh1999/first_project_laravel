<?php

use Illuminate\Database\Seeder;

class Product_categoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        if (DB::table('product_category')->count() == 0) {
            $faker = Faker\Factory::create();
            $product_category = [];
            for ($i = 1; $i < 30; ++$i) {
                $product_category[] = [
                    'product_id' => $faker->numberBetween(1, 30),
                    'category_id' => $faker->numberBetween(1, 5),
                ];
            }
            DB::table('product_category')->insert($product_category);
        }
    }
}
