<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Files;
use App\Models\FileTypes;
use App\Repositories\Repository;
use App\Services\FilesManager;

class FilesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $filetypes;

    public function __construct(FileTypes $filetypes)
    {
        // set the model
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
        return (new FilesManager())->uploadFiles($request);
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
            $files = "Delete process error";
        }

        return json_encode($files);
    }
}
