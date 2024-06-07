<?php

namespace App\Database\Repository\User;

use App\Database\Repository\BaseRepository;
use App\User;

class UserRepository extends BaseRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new User();
        parent::__construct($this->model);
    }

    public function getPaginateBootstrap()
    {
        return $this->model->where('role', '=', '1')->paginate();
    }
}
