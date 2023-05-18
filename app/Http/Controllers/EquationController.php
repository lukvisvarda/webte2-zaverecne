<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EquationController extends Controller
{
  public function checkEquation(Request $request)
  {
    $id = $request->input('id');
    $equationValue = $request->input('equationValue');
    $problem = Problem::findOrFail($id);
    $solution = $problem->solution;

    DB::table('user_problems')
      ->where('id', $id)
      ->update(['solved' => 1]);

    DB::table('user_problems')
      ->where('id', $id)
      ->update(['submitted' => 1]);

    $isEquationCorrect = ($equationValue === $solution);
    $maxPoints = DB::table('user_problems')->where('id', $id)->value('max_points');
    if ($isEquationCorrect) {
       DB::table('user_problems')
         ->where('id',$id)
         ->update(['points' => $maxPoints]);
    }

  }
}
