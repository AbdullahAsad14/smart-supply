<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientRecipeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ingredient_recipe')->insert([
            [
                'ingredient_id' => 1,
                'recipe_id' => 1,
                'amount' => 1.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'ingredient_id' => 2,
                'recipe_id' => 1,
                'amount' => 100.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'ingredient_id' => 1,
                'recipe_id' => 2,
                'amount' => 0.50,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'ingredient_id' => 2,
                'recipe_id' => 2,
                'amount' => 100.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'ingredient_id' => 3,
                'recipe_id' => 2,
                'amount' => 3.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
