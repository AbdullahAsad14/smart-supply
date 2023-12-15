<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['delivery_date'];

    /**
     * The ingredients that belong to the recipe.
     */
    public function recipes(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Recipe::class)->using(BoxRecipe::class);
    }
}
