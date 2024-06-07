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

    public function createUser(array $field)
    {
        return $this->repository->create($field);
    }
    public function deleteUser(string $id) {
        return $this->repository->delete($id);
    }
}
