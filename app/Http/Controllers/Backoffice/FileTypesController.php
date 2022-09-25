<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FileTypes;
use App\Repositories\Repository;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Backoffice\SaveFileTypeRequest;

class FileTypesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $filetypes;

    private $SUCESS_CREATED = "Dados criado com sucesso";

    private $SUCESS_UPDATED = "Dados atualizado com sucesso";

    private $SUCESS_REMOVED = "Dados removido com sucesso";

    public function __construct(FileTypes $model)
    {
        $this->model = new Repository($model);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $fileTypes = $this->model->all();

        return view('backoffice.file-types.index', compact('fileTypes'));
    }

    public function store(SaveFileTypeRequest $request)
    {
        $dados = $request->except('_token');

        $dir_path = public_path() . "/files/{$request->input('directory')}/";

        if ($dados['id'] == NULL) {
            $this->model->create($dados);

            if (!File::exists($dir_path)) {
                File::makeDirectory($dir_path, 0777, true, true);
                $msg = $this->SUCESS_CREATED;
            }
            $msg = $this->SUCESS_CREATED;
        } else {
            $all = Session::all();
            $old_dir_path = public_path() . "/files/{$all['old_dir']}/";
            if (rename($old_dir_path, $dir_path)) {
                $this->model->update($dados, $dados['id']);
                $msg = $this->SUCESS_UPDATED;
            }

            $msg = $this->SUCESS_CREATED;
        }

        return redirect()->route('file-types')->with('status', $msg);
    }

    public function edit(FileTypes $filetypes, $id=null)
    {
        if ($id) {
            
            $filetypes = $this->model->find($id);
            $filetypes->extensions = json_decode($filetypes->extensions);

            Session::put('old_dir', $filetypes->directory); //otimizar essa linha
        }
        
        return view('backoffice.file-types.edit')->with('filetypes', $filetypes);
    }

    public function getAll()
    {
        $result = FileTypes::select('id', 'directory', 'title', 'extensions', 'max_file_size')->get();

        return response()->json($result);
    }

    public function getFileType($slug)
    {

        $res = $this->model->getModel()->where('directory', $slug)->first();

        return response()->json($res);
    }

    public function delete(Request $request)
    {        
        $dir = $request->input('directory');
        $id = $request->input('id');

        try {
            $res = $this->model->delete($id);
            if ($res && $dir) {
                File::deleteDirectory(public_path() . "/files/{$dir}");
            }
        } catch (\Throwable $th) {
            dd($th);
        }

        return redirect()->route('file-types')->with('status', $this->SUCESS_REMOVED);
    }
}
