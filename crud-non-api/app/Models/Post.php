<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $appends = ['category_label'];

    public function getCategoryLabelAttribute()
    {
        if ($this->category == 0) {
            return '<span class="text-red-500">Pegunungan</span>';
        }
        return '<span class="text-indigo-600">Pantai</span>';
    }
}
