<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LatexFile extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'file', 'parsed', 'assigned'];

    protected $casts = [
        'parsed' => 'array'
    ];


}
