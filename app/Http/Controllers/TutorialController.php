<?php
namespace App\Http\Controllers;
use App\Models\Tutorial;
use Illuminate\Http\Request;

class TutorialController {
  public function getTutorial(){
    $tutorial = Tutorial::all()[0];
    return response()->json($tutorial);
  }

  public function updateTutorial(Request $request) {
    $id = 1;
    $tutorial = Tutorial::find($id);
    $tutorial->text = $request->input('text');
    $tutorial->save();
    return response()->json($tutorial);
  }
}
