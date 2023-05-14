<?php

namespace App\Http\Controllers;
use App\Enums\RolesEnum;
use App\Models\LatexFile;
use App\Models\Problem;
use App\Models\selectedFile;
use App\Models\User;
use App\Models\UserProblem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController{

  public function getUserById($id){
    $user = User::find($id);
    return response()->json($user);
  }

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
      $actualLatexFiles[] = $latexFile; // tu su aj ti ebody
    }

    $allProblems = array();
    foreach ($actualLatexFiles as $latexFile) {
      foreach ($latexFile->problems as $problem) {
        $problem->points = $latexFile->points;
        $allProblems[] = $problem;
      }
    }

//    $solvedProblems = $user->assignedProblems()->where('solved', true)->pluck('id')->toArray();
//    $assignedProblems = $user->assignedProblems()->map(function($problem){
//      return $problem->id;
//    });
    $assignedProblems = $user->assignedProblems()->pluck('problem_id')->toArray();

//    var_dump($user->assignedProblems());

    // filter out the problems that the user has already solved
//    $unsolvedProblems = array_filter($allProblems, function ($problem) use ($solvedProblems) {
//      return !in_array($problem->id, $solvedProblems);
//    });

    $unsolvedProblems = array_filter($allProblems, function ($problem) use ($assignedProblems) {
      return !in_array($problem->id, $assignedProblems);
    });


    if (empty($unsolvedProblems)) {
      // if the user has already solved all the problems, return an empty response
      return response()->json(["message"=>"Nemáte žiadne úlohy na vygenerovanie"]);
    }

    $randomProblem = $unsolvedProblems[array_rand($unsolvedProblems)];
    $randomProblemUserEntity = new UserProblem();
    $randomProblemUserEntity->solved = false;
    $randomProblemUserEntity->max_points = $randomProblem->points;
    $randomProblemUserEntity->points = 0;

    $randomProblemUserEntity->user()->associate($user);
    $randomProblemUserEntity->problem()->associate($randomProblem);
    $randomProblemUserEntity->save();
    return response()->json($randomProblem);
  }

  public function getAllStudents(){// give me only users with role student
    $users = User::where('role', RolesEnum::STUDENT)->get();
    return response()->json($users);
  }

  public function uploadImages(Request $request)
  {
    $request->validate([
      'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
      'name' => 'required|string',
    ]);

    foreach ($request->file('images') as $image) {
      $path = $image->storeAs('public/images', $image->hashName());
      $url = Storage::url($path);
    }

    $problem = Problem::where('name', $request->input('name'))->first();
    $problem->image = $url;
    $problem->save();

    return response()->json(['message' => 'Images uploaded successfully']);
  }
}
