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

    public function all()
    {
        return $this->model->all();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {
        $record = $this->model->find($id);
        return $record->update([$data]);
    }

    public function destroy(int $id)
    {
        $record = $this->model->find($id);
        return $record->delete();
    }
}

