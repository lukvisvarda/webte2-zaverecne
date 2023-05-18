<?php
namespace App\Http\Controllers;
use App\Models\Problem;
use App\Models\User;
use App\Models\UserProblem;
use Illuminate\Support\Facades\Storage;

class UserProblemController{
  public function getProblemsByStudentId($id){
    $userProblems = UserProblem::findByUser($id);
    $actualProblems = $userProblems->map(function($problem){
      return [
        "id" => $problem->id,
        "problem" => $problem->problem,
          "solved"=> $problem->solved,
          "maxPoints"=>$problem->max_points,
        "points" => $problem->points,
        "submitted" => $problem->submitted
        ];
    });
    return response()->json($actualProblems);
  }

  public function getAll(){
    $userProblems = UserProblem::all();
    return response()->json($userProblems);
  }

  public function getSingleProblem($id)
  {
    return Problem::find($id);
  }
}
