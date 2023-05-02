<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LatexFile extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'file', 'parsed', 'assigned', 'points'];

    protected $casts = [
        'parsed' => 'array'
    ];

    public function problems(){ // tu nebude fk
      return $this->hasMany(Problem::class);
    }

    public static function findByName($name){
      return static::where('name', $name)->first();
    }
}
