<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Repositories\Repository;
use App\Http\Requests\Backoffice\SaveUsersRequest;

class UserManagementController extends Controller
{
    private $model;

    public function __construct(User $model)
    {
        $this->model = new Repository($model);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->model->all();

        return view('backoffice.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backoffice.users.edit')->with('user', $this->model);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveUsersRequest $request)
    {
        $request = $request->only('id', 'name', 'email', 'password');

        if($request['password'])
            $request['password'] = bcrypt($request['password']);

        if(isset($request['id'])){


            
            //$saved = $this->model->update($request, $request['id']);
            $msg = "Dados atualizados com sucesso!";
        }else{
            //$saved  = $this->model->create($request);
            $msg = "Dados inseridos com sucesso!";
        }

        dd($msg);

        return redirect()->route('user-manegement.index')->with('status', $msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Candidatos  $candidatos
     * @return \Illuminate\Http\Response
     */
    public function show(Candidatos $candidatos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Candidatos  $candidatos
     * @return \Illuminate\Http\Response
     */
    public function edit($id=null)
    {
        $user = $this->model->find($id);

        return view('backoffice.users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Candidatos  $candidatos
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCandidatos $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Candidatos  $candidatos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->model->delete($id);

            $msg = "Dados removido com sucesso";
        } catch (\Throwable $th) {
            dd($th);
        }

        return redirect()->route('user-manegement.index')->with('status', $msg);
    }
}
