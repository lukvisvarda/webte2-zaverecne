<?php

namespace App\Http\Controllers;
use App\Enums\RolesEnum;
use App\Models\LatexFile;
use App\Models\Problem;
use App\Models\selectedFile;
use App\Models\User;
use App\Models\UserProblem;
use Illuminate\Support\Facades\Auth;

class UserController{
  public function addRandomProblemFromSelectedLatexFiles(){
    $user =  Auth::user();

    //ak nie su ziadne files na vyber tak vratim prazdny json
    if(count(selectedFile::all()) == 0){
      return response()->json();
    }
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
    $randomProblemUserEntity->solved = false;
    $randomProblemUserEntity->max_points = 5; //TODO: treba zmenit politiku bodov.
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

  public function getAllStudents(){// give me only users with role student
    $users = User::where('role', RolesEnum::STUDENT)->get();
    return response()->json($users);
  }
}
