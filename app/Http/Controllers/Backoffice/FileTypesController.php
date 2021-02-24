<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FileTypes;
use Illuminate\Support\Facades\Log;

class FileTypesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(){
        return "index";
    }

    public function store(Request $request){
        $res = FileTypes::updateOrCreate(
            ['id'=>$request->input('id'), 'directory' => $request->input('directory'), 'title' => $request->input('title'),
            'extensions' => json_encode($request->input('extensions')), 'max_file_size' => $request->input('max_file_size')]
        );

        return response()->json($res);
    }

    public function edit($id = null){

        if($id){
            $result = FileTypes::select('id', 'directory', 'title', 'extensions', 'max_file_size')->firstWhere('id', $id);

            $result->extensions = json_decode($result->extensions);

            return view('backoffice.file-types.edit', ['result'=> $result]);

        }else{
            return view('backoffice.file-types.add');
        }

    }

    public function getAll(){
        $result = FileTypes::select('id', 'directory', 'title', 'extensions', 'max_file_size')->get();

        return response()->json($result);
    }



}
