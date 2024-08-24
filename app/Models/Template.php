<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;
}


// protected $table = 'books';
// protected $fillable = ['id', 'title', 'category_id'];
// protected $primaryKey = 'id';

// public function category(): BelongsTo{
//     return $this->belongsTo(Category::class, 'id');
// }

// public function detail(): HasOne{
//     return $this->hasOne(Detail::class, 'book_id');
// }

// public function books(): HasMany{
//     return $this->hasMany(Book::class, 'category_id');
// }
