<?php
namespace App\Http\Controllers;

use App\Models\Problem;
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
        $path = $file->store('latex');
        $name = $request->name;

        $parser = new LatexParser();
        $parsedData = $parser->parse(Storage::get($path));

        $latex = new LatexFile;
        $latex->name = $file->getClientOriginalName();
        $latex->file = Storage::get($path);
        $latex->parsed = $parsedData;
        $latex->save();
        foreach ($parsedData as $problem) {
            var_dump($problem);
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
