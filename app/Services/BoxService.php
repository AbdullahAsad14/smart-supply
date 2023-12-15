<?php

namespace App\Services;

use App\Models\Box;

class BoxService
{
    /**
     * @param $data
     * @return mixed
     */
    public function createBox($data)
    {
        $box = Box::create([
            'delivery_date' => $data['delivery_date'],
        ]);
        $box->recipes()->attach($data['recipe_ids']);
        return $box;
    }

    /**
     * @param int $limit
     * @return mixed
     */
    public function getAllBoxes(int $limit)
    {
        return Box::paginate($limit);
    }
}
