<?php

namespace App\Http\Controllers;
use App\Models\LatexFile;
use App\Models\Problem;
use App\Models\selectedFile;
use App\Models\User;
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

    if($user instanceof User){
      $user->assignedProblems()->attach($randomProblem['id']);
    }
    $user->save();
    return response()->json($randomProblem);
  }
}
