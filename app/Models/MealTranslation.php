<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable;

class MealTranslation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'meal_id',
        'language_id',
        'title',
        'description',
    ];

    public $translatedAttributes = [
        'title',
        'description',
    ];

    protected $hidden = [
        'id',
        'meal_id',
        'language_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function language() {
        return $this->belongsTo(Language::class);
    }
}
