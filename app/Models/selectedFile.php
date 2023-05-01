<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class selectedFile extends Model
{
  use HasFactory;

  protected $table = 'assigned_thesis';

  protected $fillable = ['selectedFiles'];

  protected $casts = [
    'selectedFiles' => 'array'
  ];
}
