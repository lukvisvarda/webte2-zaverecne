<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LatexFile;
use Illuminate\Support\Facades\Storage;
use App\Services\LatexParser;

class MathController {
  public function solve(Request $request){
    $maximaDir = 'C:\Data\maxima\maxima-5.46.0';
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    $input = $data['input'];
    exec($maximaDir.'/bin/maxima.bat -q -b'.$input);
  }
}
