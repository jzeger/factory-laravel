<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'meal_id',
        'tag_id'
    ];

    protected $table = 'meal_tag';
}