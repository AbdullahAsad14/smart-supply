<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(IngredientsTableSeeder::class);
        $this->call(RecipesTableSeeder::class);
        $this->call(BoxesTableSeeder::class);
        $this->call(IngredientRecipeTableSeeder::class);
        $this->call(BoxRecipeTableSeeder::class);
    }
}
