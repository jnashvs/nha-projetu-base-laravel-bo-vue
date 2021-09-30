<?php 
namespace App\Repositories;

interface RepositoryInterface
{
    public function all($search_by = null, $search = null, $query = null, $paginate = true);

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function find($id);
}