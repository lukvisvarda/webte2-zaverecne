<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LatexFile;
use Illuminate\Support\Facades\Storage;
use App\Services\LatexParser;

class ParserController extends Controller
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

        return response()->json($latex->parsed);
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
