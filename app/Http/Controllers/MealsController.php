<?php

namespace App\Http\Controllers;

use App\Classes\MealsFilter;
use App\Http\Requests\MealRequest;

class MealsController extends Controller
{
    public function index(MealRequest $request, MealsFilter $meals)
    {
        $result = $meals->filter($request);

        $response = json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

        return response($response)->header('Content-Type', 'application/json');
    }
}
