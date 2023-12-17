<?php

namespace App\Services;

use App\Models\Recipe;

class RecipeService
{
    /**
     * @param $data
     * @return mixed
     */
    public function createRecipe($data)
    {
        $recipeIngredients = [];
        foreach($data['ingredients'] as $ingredient) {
            $recipeIngredients[$ingredient['id']] = ['amount' => $ingredient['amount']];
        }

        $recipe = Recipe::create([
            'name' => $data['name'],
            'description' => $data['description'],
        ]);

        $recipe->ingredients()->attach($recipeIngredients);

        return $recipe;
    }

    /**
     * @param int $limit
     * @return mixed
     */
    public function getAllRecipes(int $limit)
    {
        return Recipe::paginate($limit);
    }
}
