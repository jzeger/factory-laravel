<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'pivot',
    ];

    public function meals() {
        return $this->belongsToMany(Meal::class);
    }

    public function translations() {
        return $this->hasMany(IngredientTranslation::class);
    }

    public function translation() {
        return $this->hasOne(IngredientTranslation::class);
    }
}
