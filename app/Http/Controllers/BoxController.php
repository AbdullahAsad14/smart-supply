<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreBoxRequest;
use App\Services\BoxService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BoxController extends Controller
{

    /**
     * @var $boxService
     */
    private $boxService;

    /**
     * @param BoxService $boxService
     */
    public function __construct(BoxService $boxService)
    {
        $this->boxService = $boxService;
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
        $boxes = $this->boxService->getAllBoxes($limit);
        return response($boxes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBoxRequest $request
     * @return Response
     */
    public function store(StoreBoxRequest $request)
    {
        $data = $request->only(['delivery_date', 'recipe_ids']);
        $box = $this->boxService->createBox($data);
        return response($box);
    }
}
