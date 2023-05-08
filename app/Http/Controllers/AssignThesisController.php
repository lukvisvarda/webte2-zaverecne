<?php

namespace App\Http\Controllers;

use App\Models\selectedFile;
use Illuminate\Http\Request;

class AssignThesisController extends Controller
{
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function store(Request $request)
  {
    $selectedOptions = $request->input('selectedOptions');

    selectedFile::truncate();

      selectedFile::create([
        'selectedFiles' => $selectedOptions
      ]);




    return response()->json(['message' => 'Selected options saved successfully.']);
  }



  public function getAssignedThesis() {
    $selectedFiles = selectedFile::all()[0];
    return response()->json($selectedFiles);
  }
}
