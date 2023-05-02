<?php

namespace App\Http\Controllers;
use App\Models\LatexFile;
use App\Models\Problem;
use App\Models\selectedFile;
use App\Models\User;
use App\Models\UserProblem;
use Illuminate\Support\Facades\Auth;

class UserController{
  public function addRandomProblemFromSelectedLatexFiles(){
    $user =  Auth::user();
    $selectedFiles = selectedFile::all()[0]['selectedFiles'];

    $arr = $selectedFiles ;
    $actualLatexFiles = array();

    foreach ($arr as $fileId) {
      $latexFile = LatexFile::findByName($fileId);
      $actualLatexFiles[] = $latexFile;
    }

    $allProblems = array();
    foreach ($actualLatexFiles as $latexFile) {
      foreach ($latexFile->problems as $problem) {
        $allProblems[] = $problem;
      }
    }

    $randomProblem = $allProblems[array_rand($allProblems)];
    $randomProblemUserEntity = new UserProblem();
//    $randomProblemUserEntity->user_id = $user['id'];
//    $randomProblemUserEntity->problem_id = $randomProblem['id'];
    $randomProblemUserEntity->solved = false;
    $randomProblemUserEntity->max_points = $randomProblem['points'];
    $randomProblemUserEntity->points = 0;

    $randomProblemUserEntity->user()->associate($user);
    $randomProblemUserEntity->problem()->associate($randomProblem);
    $randomProblemUserEntity->save();
//    if($user instanceof User){
//      $user->assignedProblems()->attach($randomProblem['id']);
//    }
//    $user->save();
    return response()->json($randomProblem);
  }
}
