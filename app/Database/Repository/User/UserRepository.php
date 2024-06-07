<?php

namespace App\Database\Repository\User;

use App\Database\Repository\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends BaseRepository
{
    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
        parent::__construct($this->model);
    }
}
