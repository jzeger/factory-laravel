<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MealRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'per_page' => 'integer|min:1',
            'page' => 'integer|min:1',
            'category' => 'string|nullable',
            'tags' => 'string|nullable|regex:/^\s*\d+(\s*,+\s*\d+)*\s*$/',
            'with' => 'string|nullable|regex:/^[a-z][a-z_,]+[a-z]$/',
            'lang' => 'required|regex:/^[a-zA-Z]{2,3}([-\/][a-zA-Z]{2,3})?$/',
            'diff_time' => 'integer|min:1'
        ];
    }
}
