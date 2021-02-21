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
        return view('backoffice.files.add');
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

        $isActive = $request->input('isActive');

        if (isset($isActive)) {
            $query->where("file_type_id", $isActive);
        }

        $data = $query->paginate($length);
        
        return new DataTableCollectionResource($data);
    }



}
