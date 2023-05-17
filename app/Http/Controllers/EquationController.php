<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use Illuminate\Http\Request;

class EquationController extends Controller
{
  public function checkEquation(Request $request)
  {
    $id = $request->input('id');
    $equationValue = $request->input('equationValue');

    // zlomky v latex su dfrac, vo vue frac, toto ich prepise
//    $equationValue = str_replace('\frac', '\dfrac', $equationValue);

    $problem = Problem::findOrFail($id);

    $neviem = $equationValue;
    $solution = $problem->solution;

    // Perform equation value comparison logic here and return the result
    // You can update this code to match your specific comparison logic
    error_log('Equation Value: ' . $equationValue); // Log equation value to console
    error_log('Solution: ' . $solution); // Log solution to console

    if ($equationValue === $solution) {
      error_log("fungujem");
      return response()->json(['solution' => $solution]);

    } else {
      error_log("nefungujem");
      return response()->json(['neviem' => $neviem]);
    }
//    return response()->json(['neviem' => $neviem]);

  }
}
