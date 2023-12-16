<?php

namespace Tests\Feature;

use Tests\TestCase;

class RecipeTest extends TestCase
{
    /**
     * Test store recipe success
     *
     * @return void
     */
    public function test_store_recipe_success()
    {
        $recipe = [
            'name' => 'Test Recipe',
            'description' => 'Test Description',
            'ingredients' => [
                ['id' => 1, 'amount' => 1.00],
                ['id' => 2, 'amount' => 2.50],
            ],
        ];
        $response = $this->json('POST', '/api/recipes', $recipe);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'name',
                'description',
                'created_at',
                'updated_at',

            ])->assertJson([
                'name' => 'Test Recipe',
                'description' => 'Test Description',
            ]);
    }

    /**
     * Test store recipe validation failed if empty request
     *
     * @return void
     */
    public function test_store_recipe_validation_failed_if_empty_request()
    {
        $response = $this->json('POST', '/api/recipes');
        $response->assertStatus(422)
            ->assertJsonStructure([
                'success',
                'message',
                'data'
            ])->assertJson([
                'success' => false,
                'message' => "Validation errors!",
                'data' => [
                    "name" => [
                        "Please provide a name for the recipe."
                    ],
                    "description" => [
                        "Please provide a description for the recipe."
                    ],
                    "ingredients" => [
                        "Please add at least one ingredient to the recipe."
                    ]
                ]
            ]);
    }

    /**
     * Test store recipe validation failed if ingredient does not exist
     *
     * @return void
     */
    public function test_store_recipe_validation_failed_if_ingredient_does_not_exist()
    {
        $recipe = [
            'name' => 'Test Recipe',
            'description' => 'Test Description',
            'ingredients' => [
                ['id' => 0, 'amount' => 1.00],
            ],
        ];
        $response = $this->json('POST', '/api/recipes', $recipe);
        $response->assertStatus(422)
            ->assertJsonStructure([
                'success',
                'message',
                'data'
            ])->assertJson([
                'success' => false,
                'message' => "Validation errors!",
                'data' => [
                    "ingredients.0.id" => [
                        "Selected ingredient does not exist."
                    ]
                ]
            ]);
    }

    /**
     * Test store recipe validation failed if amount of ingredient is 0
     *
     * @return void
     */
    public function test_store_recipe_validation_failed_if_ingredient_amount_is_zero()
    {
        $recipe = [
            'name' => 'Test Recipe',
            'description' => 'Test Description',
            'ingredients' => [
                ['id' => 1, 'amount' => 0.00],
            ],
        ];
        $response = $this->json('POST', '/api/recipes', $recipe);
        $response->assertStatus(422)
            ->assertJsonStructure([
                'success',
                'message',
                'data'
            ])->assertJson([
                'success' => false,
                'message' => "Validation errors!",
                'data' => [
                    "ingredients.0.amount" => [
                        "Ingredient amount should be greater than zero."
                    ]
                ]
            ]);
    }
}
