<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
  use HasFactory;

  public mixed $users = array();

  protected $fillable = ['name', 'task', 'image', 'solution'];

  protected $casts = [
    'parsed' => 'array'
  ];



  public function latexFile(){ // tu bude fk
    return $this->belongsTo(LatexFile::class);
  }

  public function users()
  {
    return $this->hasMany(UserProblem::class);
//    return $this->belongsToMany(User::class);
  }

  public static function find(mixed $id)
  {
    return static::where('id', $id)->first();
  }
}
