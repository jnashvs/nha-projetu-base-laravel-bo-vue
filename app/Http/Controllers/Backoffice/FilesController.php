<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\Files;
use function GuzzleHttp\json_encode;
use Illuminate\Support\Facades\Storage;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;
use App\Models\FileTypes;

class FilesController extends Controller
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
    public function index()
    {
        $result = FileTypes::select('id', 'directory')->get();

        return view('backoffice.files.add', ['filetypes'=> $result]);
    }

    public function fileStore(Request $request)
    {
        $file = $request->file('file');

        if($file){

            $file_name = Str::random().'-'.$file->getClientOriginalName();
            $file->move(storage_path('files'), $file_name);

            $res = Files::create(
                [
                    'path' => $file_name,
                    'size' => 0
                ]
            );

            return json_encode($res);
        }
    }

    // public function allFiles(Request $request){
    //     Log::info($request->all());

    //     return json_encode(Files::all());
    // }

    public function allFiles(Request $request)
    {   
        $length = $request->input('length');
        $sortBy = $request->input('column');
        $orderBy = $request->input('dir');
        $searchValue = $request->input('search');
        
        $query = Files::eloquentQuery($sortBy, $orderBy, $searchValue);

        Log::info($request->input('isActive'));

        // if (isset($isActive)) {
        //     $query->where("file_type_id", $isActive);
        // }

        // $query = Files::eloquentQuery($sortBy, $orderBy, $searchValue);

        // $directory = $request->input('directory');

        // Log::info($request->all());

        // if (isset($directory)) {
        //     $dir = FileTypes::select('id', 'directory')->firstWhere('directory', $directory);

        //     $query->where("file_type_id", $dir->id);
        // }

        $data = $query->paginate($length);
        
        return new DataTableCollectionResource($data);
    }



}
