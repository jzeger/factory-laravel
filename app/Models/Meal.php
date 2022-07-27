<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meal extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
    ];

    protected $hidden = [
        'category_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function ingredients() {
        return $this->belongsToMany(Ingredient::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function categoryTranslations() {
        return $this->hasManyThrough(CategoryTranslation::class, Category::class, 'id', 'category_id');
    }

    public function translations() {
        return $this->hasMany(MealTranslation::class);
    }

    public function translation() {
        return $this->hasOne(MealTranslation::class);
    }
}