<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProblem extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'problem_id', 'solved', 'max_points', 'points', 'submitted'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function problem()
    {
        return $this->belongsTo(Problem::class);
    }

    public static function find(mixed $id)
    {
        return static::where('id', $id)->first();
    }

    public static function findByUserAndProblem(mixed $user_id, mixed $problem_id)
    {
        return static::where('user_id', $user_id)->where('problem_id', $problem_id)->first();
    }

    public static function findByUser(mixed $user_id)
    {
        return static::where('user_id', $user_id)->get();
    }

    public static function findByProblem(mixed $problem_id)
    {
        return static::where('problem_id', $problem_id)->get();
    }
}
