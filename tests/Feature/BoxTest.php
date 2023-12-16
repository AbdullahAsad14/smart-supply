<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;

class BoxTest extends TestCase
{
    /**
     * Test store box success
     *
     * @return void
     */
    public function test_store_box_success()
    {
        $deliveryDate = Carbon::now()->addDays(3)->toDateString();
        $box = [
            'delivery_date' => $deliveryDate,
            'recipe_ids' => [1, 2]
        ];
        $response = $this->json('POST', '/api/boxes', $box);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'delivery_date',
                'created_at',
                'updated_at',

            ])->assertJson([
                'delivery_date' => $deliveryDate,
            ]);
    }

    /**
     * Test store box validation failed when empty request
     *
     * @return void
     */
    public function test_store_box_validation_failed_if_empty_request()
    {
        $response = $this->json('POST', '/api/boxes');
        $response->assertStatus(422)
            ->assertJsonStructure([
                'success',
                'message',
                'data'
            ])->assertJson([
                'success' => false,
                'message' => "Validation errors!",
                'data' => [
                    "delivery_date" => [
                        "Delivery date is required."
                    ],
                    "recipe_ids" => [
                        "Please include at least one recipe in the box."
                    ]
                ]
            ]);
    }

    /**
     * Test store box validation failed when delivery is in past
     *
     * @return void
     */
    public function test_store_box_validation_failed_if_delivery_date_is_in_past()
    {
        $deliveryDate = Carbon::now()->subDay()->toDateString();
        $box = [
            'delivery_date' => $deliveryDate,
            'recipe_ids' => [1, 2]
        ];
        $response = $this->json('POST', '/api/boxes', $box);
        $response->assertStatus(422)
            ->assertJsonStructure([
                'success',
                'message',
                'data'
            ])->assertJson([
                'success' => false,
                'message' => "Validation errors!",
                'data' => [
                    "delivery_date" => [
                        "Delivery date should be at least 48 hours from the current time."
                    ]
                ]
            ]);
    }

    /**
     * Test store box validation failed when delivery is within next 2 days
     *
     * @return void
     */
    public function test_store_box_validation_failed_if_delivery_date_is_within_next_2_days()
    {
        $deliveryDate = Carbon::now()->addDay()->toDateString();
        $box = [
            'delivery_date' => $deliveryDate,
            'recipe_ids' => [1, 2]
        ];
        $response = $this->json('POST', '/api/boxes', $box);
        $response->assertStatus(422)
            ->assertJsonStructure([
                'success',
                'message',
                'data'
            ])->assertJson([
                'success' => false,
                'message' => "Validation errors!",
                'data' => [
                    "delivery_date" => [
                        "Delivery date should be at least 48 hours from the current time."
                    ]
                ]
            ]);
    }

    /**
     * Test store box validation failed when recipe does not exist
     *
     * @return void
     */
    public function test_store_box_validation_failed_if_recipe_does_not_exist()
    {
        $deliveryDate = Carbon::now()->addDays(3)->toDateString();
        $box = [
            'delivery_date' => $deliveryDate,
            'recipe_ids' => [0]
        ];
        $response = $this->json('POST', '/api/boxes', $box);
        $response->assertStatus(422)
            ->assertJsonStructure([
                'success',
                'message',
                'data'
            ])->assertJson([
                'success' => false,
                'message' => "Validation errors!",
                'data' => [
                    "recipe_ids.0" => [
                        "Recipe with this ID does not exist."
                    ]
                ]
            ]);
    }
}
