<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\UserProblem;

class UserProblemController{
  public function getProblemsByStudentId($id){
    $userProblems = UserProblem::findByUser($id);
    $actualProblems = $userProblems->map(function($problem){
      return ["problem" => $problem->problem,
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
}
