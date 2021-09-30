<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class UserRepository implements RepositoryInterface
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    // Get all instances of model
    public function all($search_by = null, $search = null, $query = null, $paginate = true)
    {

        if (is_null($query)) {
            $query = $this->model;
        }

        if($search_by && $search){
            $query = $query->where($search_by, 'LIKE', '%'.$search.'%');
        }

        if ($paginate) {
            return $query->paginate();
        }

        return $query->get();
    }

    // create a new record in the database
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    // update record in the database
    public function update(array $data, $id)
    {
        $record = $this->find($id);
        if(!$data["password"])
            $data["password"] = $record->password;
            
        return $record->update($data);
    }

    // remove record from the database
    public function delete($id = null)
    {
        return $this->model->destroy($id);
    }

    // show the record with the given id
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    // Get the associated model
    public function getModel()
    {
        return $this->model;
    }

    // Set the associated model
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    // Eager load database relationships
    public function with($relations)
    {
        return $this->model->with($relations);
    }
}
