<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IngredientTest extends TestCase
{
    /**
     * Test store ingredient success
     *
     * @return void
     */
    public function test_store_ingredient_success()
    {
        $ingredient = [
            'name' => "Salmon",
            'measure' => "kg",
            'supplier' => 'Fishers Inc.'
        ];
        $response = $this->json('POST', '/api/ingredients', $ingredient);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'name',
                'measure',
                'supplier',
                'created_at',
                'updated_at',

            ])->assertJson($ingredient);
    }

    /**
     * Test store ingredient gets validation error when request is empty
     *
     * @return void
     */
    public function test_store_ingredient_gets_a_validation_error_if_request_is_empty()
    {
        $response = $this->json('POST', '/api/ingredients', []);
        $response->assertStatus(422)
            ->assertJsonStructure([
                'success',
                'message',
                'data'
            ])
            ->assertJson([
                'success' => false,
                'message' => "Validation errors!",
                'data' => [
                    "name" => [
                        "Please provide the name of the ingredient."
                    ],
                    "measure" => [
                        "The unit of measure is required."
                    ],
                    "supplier" => [
                        "Please specify the supplier."
                    ]
                ]
            ]);
    }

    /**
     * Test get ingredients success
     *
     * @return void
     */
    public function test_get_ingredients_success()
    {
        $response = $this->json('GET', '/api/ingredients');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'current_page',
                'data',
                'from',
                'to',
                'total',
                'per_page',

            ]);
    }

    /**
     * Test get required ingredients success
     *
     * @return void
     */
    public function test_get_required_ingredients_success()
    {
        $response = $this->json('GET', '/api/required-ingredients?order_date=' . Carbon::now()->toDateString());
        $response->assertStatus(200);
    }
}
