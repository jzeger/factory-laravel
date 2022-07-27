<?php

namespace App\Classes;

use App\Models\Meal;
use App\Models\Language;
use App\Http\Resources\MealResource;
use Illuminate\Support\Carbon;

class MealsFilter extends Meal
{
    protected $table = 'meals';

    public function filter($request) 
    {
        // prepare 'lang' parameter
        $lang = $request->lang;
        $lang_id = Language::where('lang', $lang)->value('id');

        // prepare 'with' parameter
        $with = explode(",", $request->with);

        // prepare 'category' parameter
        $category_operator = '=';
        $category_id = $request->category;
        if ($request->category > 0) {
            $category_id = $request->category;
        } else if ($request->category === NULL) {
            $category_id = NULL;
        } else if ($request->category != NULL) {
            $category_operator = ">";
            $category_id = "0";
        }

        // prepare 'tags' parameter
        $tags = array_map('intval', explode(",", $request->tags));

        // pagination parameter
        $per_page = $request->per_page;

        // query meals
        $meals = Meal::query();

        // get meal translations
        $meals = $meals->with('translation', function ($q) use($lang_id) {
            $q->where('language_id', '=', $lang_id);
        });

        // get meals created, updated or deleted after diff_time
        if($request->diff_time) {
            $date = Carbon::createFromTimestamp($request->diff_time);
            $meals
            ->withTrashed()
            ->where(function($q) use($date){
                $q->orWhere('created_at', '>', $date)
                ->orWhere('updated_at', '>', $date)
                ->orWhere('deleted_at', '>', $date);
            });
        }

        // get meal category
        if(array_search("category", $with) !== false) {
            $meals = $meals->with('category.translation', function ($q) use($lang_id) {
                $q->where('language_id', '=', $lang_id);
            });
        }
        $meals->where('category_id', $category_operator, $category_id);  
        
        // get meal tags
        if(array_search("tags", $with) !== false) {
            $meals = $meals->with('tags.translation', function ($q) use($lang_id) {
                $q->where('language_id', '=', $lang_id);
            });
        }

        if($request->tags){
            foreach ($tags as $tag) {
                $meals->whereHas('tags', function($q) use($tag) {
                    $q->where('id', "=", $tag);
                });
            }
        }

        // get meal ingredients
        if(array_search("ingredients", $with) !== false) {
            $meals = $meals->with('ingredients.translations', function ($q) use($lang_id) {
                $q->where('language_id', '=', $lang_id);
            });
        }

        if(isset($per_page)) {
            return MealResource::collection(
                $meals->paginate($per_page)
                        ->appends(request()->except('page')))
                            ->response()->getData();
        } else {
            return MealResource::collection($meals->get())->response()->getData();
        }
    }
}