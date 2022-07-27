<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'language_id',
        'title'
    ];

    protected $hidden = [
        'id',
        'language_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function language() {
        return $this->belongsTo(Language::class);
    }
}
