<?php

namespace App\Http\Interfaces;

interface RepositoriesInterface
{
    public function all();

    public function create(array $data);

    public function update(int $id , array $data);

    public function destroy(int $id);
}
