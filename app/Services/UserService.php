<?php

namespace App\Services;

use App\Database\Repository\BaseRepository;

class UserService
{
    private $repository;

    public function __construct(BaseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createUser(array $fields)
    {
        return $this->repository->create($fields);
    }

    public function updateUser(int $id, array $fields)
    {
        $fields['cpf'] = clear_caracteres($fields['cpf']);
        return $this->repository->updateById($id, $fields);
    }

    public function delete(string $id)
    {
        return $this->repository->delete($id);
    }

    public function getPaginateBootstrap()
    {
        return $this->repository->getPaginateBootstrap();
    }

    public function findById($id)
    {
        return $this->repository->findById($id);
    }

    public function withRelations($id, array $array)
    {
        return $this->repository->withRelations($id, $array);
    }
}
