<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\Files;
use App\Models\FileTypes;
use App\Repositories\Repository;

class FilesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $model;

    public function __construct(Files $files)
    {
       // set the model
       $this->model = new Repository($files);
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

        $result = FileTypes::select('id', 'directory')->firstWhere('directory', $request->input('path'));

        if($file && $result){

            $path = "files/$result->directory/";

            $file_name = Str::random().'-'.$file->getClientOriginalName();
            $res = $file->move(public_path($path), $file_name);

            Log::info($res);

            $res = Files::create(
                [
                    'path' => $path.$file_name,
                    'file_type_id' => $result->id,
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
        
        $columns = ['id', 'path', 'file_type_slug'];
        
        $directory = $request->input('file_type_slug');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $order = $dir;
        $paginate = true;
        $query = null;

        $searchValue = $request->input('search');

        if (isset($directory)) {
            $dir = FileTypes::select('id', 'directory')->firstWhere('directory', $directory);

            $query = $this->model->getModel()->where("file_type_id", $dir->id)->orderBy($columns[$column], $order);

            if($searchValue){
                $query->where(function($query) use ($searchValue){
                    $query->where('path', 'like', '%'.$searchValue.'%');
                });
            }
        }

        $data = $this->model->all($query, $paginate);
        
        return ['data'=>$data, 'draw' => $request->input('draw')];
    }



}
