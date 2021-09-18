<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\Files;
use App\Models\FileTypes;
use App\Repositories\Repository;
use function GuzzleHttp\json_decode;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $files;
    protected $filetypes;

    public function __construct(Files $files, FileTypes $filetypes)
    {
        // set the model
        $this->files = new Repository($files);
        $this->filetypes = new Repository($filetypes);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $result = $this->filetypes->getModel()->select('id', 'directory')->get();

        return view('backoffice.files.add', ['filetypes' => $result]);
    }

    public function fileStore(Request $request)
    {
        $file = $request->file('file');

        $result = $this->filetypes->getModel()->select('id', 'directory')->firstWhere('directory', $request->input('path'));

        if ($file && $result) {

            $path = "files/$result->directory/";

            $file_name = Str::random() . '-' . $file->getClientOriginalName();
            $res = $file->move(public_path($path), $file_name);

            $res = $this->files->create(
                [
                    'path' => $path . $file_name,
                    'file_type_id' => $result->id,
                    'size' => 0
                ]
            );

            return json_encode($res);
        } else {
            return json_encode(["error" => "Nenhum diretorio encontrado"]);
        }
    }

    public function allFiles(Request $request)
    {

        $columns = ['id', 'path', 'created_at'];

        $directory = $request->input('file_type_slug');
        $column = $request->input('column');
        $dir = $request->input('dir');
        $order = $dir;
        $paginate = true;
        $query = null;

        $searchValue = $request->input('search');

        $dir = $this->filetypes->getModel()->select('id', 'directory')->firstWhere('directory', $directory);

        $id = $dir ? $dir->id : 0;

        $query = $this->files->getModel()->where("file_type_id", $id)->orderBy($columns[$column], $order);

        if ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('path', 'like', '%' . $searchValue . '%');
            });
        }

        $data = $this->files->all($query, $paginate);

        return ['data' => $data, 'draw' => $request->input('draw')];
    }

    public function removeFile($id)
    {

        $res = $this->files->find($id);
        
        $deleted = $this->files->delete($res->id);

        if (file_exists(public_path($res->path))) {

            unlink(public_path($res->path));
            $files = "Delete process success";
        } else {

            dd('File does not exists.');
            $files = "Delete process error";
        }
        

        return json_encode($files);
    }
}
