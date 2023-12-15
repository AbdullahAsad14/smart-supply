<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetRequiredIngredientsRequest;
use App\Http\Requests\StoreIngredientRequest;
use App\Services\IngredientService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class IngredientController extends Controller
{

    /**
     * @var $ingredientService
     */
    private $ingredientService;

    /**
     * @param IngredientService $ingredientService
     */
    public function __construct(IngredientService $ingredientService)
    {
        $this->ingredientService = $ingredientService;
    }

    /**
     * Return a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $limit = (int)$request->get('limit') ?? 10;
        $ingredients = $this->ingredientService->getAllIngredients($limit);
        return response($ingredients);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreIngredientRequest $request
     * @return Response
     */
    public function store(StoreIngredientRequest $request): Response
    {
        $data = $request->only(['name', 'measure', 'supplier']);
        $ingredient = $this->ingredientService->createIngredient($data);
        return response($ingredient);
    }

    /**
     * Return a listing of the required resources.
     *
     * @param GetRequiredIngredientsRequest $request
     * @return Response
     */
    public function getRequiredIngredients(GetRequiredIngredientsRequest $request): Response
    {
        $data = $request->only(['order_date', 'supplier']);
        $ingredients = $this->ingredientService->getRequiredIngredients($data);
        return response($ingredients);
    }
}
