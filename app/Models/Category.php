<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function meals() {
        return $this->belongsToMany(Meal::class);
    }

    public function translations() {
        return $this->hasMany(CategoryTranslation::class);
    }

    public function translation() {
        return $this->hasOne(CategoryTranslation::class);
    }
}
