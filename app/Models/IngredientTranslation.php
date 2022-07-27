<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngredientTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'ingredient_id',
        'language_id',
        'title'
    ];

    protected $hidden = [
        'id',
        'ingredient_id',
        'language_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'pivot'
    ];

    public function language() {
        return $this->belongsTo(Language::class);
    }
}
