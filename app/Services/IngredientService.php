<?php

namespace App\Services;

use App\Models\Ingredient;
use Carbon\Carbon;
use Carbon\CarbonInterface;

class IngredientService
{
    /**
     * @param $data
     * @return mixed
     */
    public function createIngredient($data)
    {
        return Ingredient::create($data);
    }

    /**
     * @param int $limit
     * @return mixed
     */
    public function getAllIngredients(int $limit)
    {
        return Ingredient::paginate($limit);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function getRequiredIngredients($data)
    {
        $orderDate = Carbon::parse($data['order_date']);
        $filters['supplier'] = $data['supplier'] ?? null;
        $filters['start_date'] = $orderDate->toDateString();
        $filters['end_date'] = $orderDate->addDays(CarbonInterface::DAYS_PER_WEEK)->toDateString();
        return Ingredient::getRequiredIngredients($filters);
    }
}
