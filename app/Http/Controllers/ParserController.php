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
        $latex->name = $name;
        $latex->file = Storage::get($path);
        $latex->parsed = $parsedData;
        $latex->save();

        return $latex->parsed;
    }
}
