<?php
namespace App\Http\Controllers;

use App\Models\Problem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\LatexFile;
use Illuminate\Support\Facades\Storage;
use App\Services\LatexParser;
use function GuzzleHttp\Promise\all;

class  ParserController extends Controller
{
    public function store(Request $request)
    {
      $file = $request->file('file');
      $points = $request->input('points');
      $path = $file->store('latex');
      $parser = new LatexParser();
      $parsedData = $parser->parse(Storage::get($path));

      $available_from = null;
      if ($request->input('dateFrom') != 'null') {
        $available_from =  Carbon::parse(preg_replace('/\sGMT.*/', '', $request->input('dateFrom')));
      }

      $available_to = null;
      if ($request->input('dateTo') != 'null') {
        $available_to =  Carbon::parse(preg_replace('/\sGMT.*/', '', $request->input('dateTo')));
      }

        $latex = new LatexFile;
        $latex->name = $file->getClientOriginalName();
        $latex->file = Storage::get($path);
        $latex->parsed = $parsedData;
        $latex->points = $points;
        $latex->available_from = $available_from;
        $latex->available_to = $available_to;
        $latex->save();
        foreach ($parsedData as $problem) {
//            var_dump($problem);
            $problem2 = new Problem;
            $problem2->name = $problem['name'];
            $problem2->task = $problem['task'];
            $problem2->image = $problem['image'];
            $problem2->solution = $problem['solution'];

//            $problem2->task = $problem->task;
//            $problem2->image = $problem->image;
//            $problem2->solution = $problem->solution;


            $problem2->latex_file_id = $latex->id;
            $problem2->save();
        }

//        return response()->json($latex->parsed);
    }

    // show all latex files in the database
    public function index()
    {
        return LatexFile::all();
    }

    public function assign($id){
        $latex = LatexFile::find($id);
        $latex->assigned = true;
        $latex->save();
        return response()->json($latex);
    }
}
