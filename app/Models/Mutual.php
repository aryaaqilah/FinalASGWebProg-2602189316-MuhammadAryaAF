<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mutual extends Model
{
    use HasFactory;
    protected $table='mutuals';
    protected $guarded = ['id'];
}
