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
        $filters['supplier'] = $data['supplier'] ?? null;
        $filters['delivery_date'] = $data['delivery_date'] ?? null;
        $startDate = Carbon::parse($data['order_date'])->toDateString();
        $endDate = Carbon::parse($data['order_date'])->addDays(CarbonInterface::DAYS_PER_WEEK)->toDateString();
        return Ingredient::getRequiredIngredients($startDate, $endDate, $filters);
    }
}
