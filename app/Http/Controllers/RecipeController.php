<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecipeRequest;
use App\Services\RecipeService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RecipeController extends Controller
{
    /**
     * @var $recipeService
     */
    private $recipeService;

    /**
     * @param RecipeService $recipeService
     */
    public function __construct(RecipeService $recipeService)
    {
        $this->recipeService = $recipeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $limit = (int)$request->get('limit') ?? 10;
        $recipes = $this->recipeService->getAllRecipes($limit);
        return response($recipes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRecipeRequest $request
     * @return Response
     */
    public function store(StoreRecipeRequest $request)
    {
        $data = $request->only(['name', 'description', 'ingredients']);
        $recipe = $this->recipeService->createRecipe($data);
        return response($recipe);
    }
}
