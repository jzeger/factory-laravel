<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meal;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class MealsController extends Controller
{
    public function index(Request $request)
    {
        // validate URL parameters
        $validator = Validator::make($request->all(), [
            'per_page' => 'integer',
            'page' => 'integer',
            'category' => 'string|nullable',
            'tags' => 'string|nullable',
            'with' => 'string|nullable',
            'lang' => 'required|string',
            'diff_time' => 'integer|min:1'
        ])->validate();

        // meal parameters
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
        $tags = array_map('intval', explode(",", $request->tags));

        // pagination parameters
        $per_page = $request->per_page;
        $page = $request->page;

        // other parameters
        $lang = $request->lang;
        $with = explode(",", $request->with);
        $diff_time = $request->diff_time;
        

        // get meals with translation
        $query = Meal::with(['translations' => function($translation) use($lang) {
            return $translation->whereHas('language', function($language) use($lang) {
                return $language->where('lang', "=", $lang);
            });
        }]);
        
        // check category
        if(array_search("category", $with) !== false) {
            $query->with(["category.translations" => function($translation) use($lang) {
                return $translation->whereHas('language', function($language) use($lang) {
                    return $language->where('lang', "=", $lang);
                });
            }]);
        }
        
        $query->where('category_id', $category_operator, $category_id);
            
        // check tags
        if(array_search("tags", $with) !== false) {
            $query->with(["tags.translations" => function($translation) use($lang) {
                return $translation->whereHas('language', function($language) use($lang) {
                    return $language->where('lang', "=", $lang);
                });
            }]);
        }
        
        if($request->tags){
            foreach ($tags as $tag) {
                $query->whereHas('tags', function($q) use($tag) {
                    $q->where('id', "=", $tag);
                });
            }
        }

        // check ingredients
        if(array_search("ingredients", $with) !== false) {
            $query->with(["ingredients.translations" => function($translation) use($lang) {
                return $translation->whereHas('language', function($language) use($lang) {
                    return $language->where('lang', "=", $lang);
                });
            }]);
        }

        // check diff_time
        if($request->diff_time) {
            $date = Carbon::createFromTimestamp($diff_time);
            $query
            ->withTrashed()
            ->where(function($q) use($date){
                $q->orWhere('created_at', '<', $date)
                ->orWhere('updated_at', '<', $date)
                ->orWhere('deleted_at', '<', $date);
            });
        }

        $result = $query->orderBy('id')->paginate($per_page);

        $response = json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

        return response($response)->header('Content-Type', 'application/json');
    }
}
