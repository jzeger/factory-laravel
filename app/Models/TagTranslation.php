<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'tag_id',
        'language_id',
        'title'
    ];

    protected $hidden = [
        'id',
        'tag_id',
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
