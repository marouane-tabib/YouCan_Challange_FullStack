<?php

namespace App\Repositories;

use App\Http\Interfaces\RepositoriesInterface;
use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoriesInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(array $select = [])
    {
        return $select ? $this->model->all($select) : $this->model->all();
    }

    public function create(array $data)
    {
        $this->model->create($data);
        return redirect()->back();
    }

    public function update(int $id, array $data)
    {
        return $this->model->find($id)->update([$data]);
    }

    public function destroy(int $id)
    {
        return $this->model->find($id)->delete();
    }
}

