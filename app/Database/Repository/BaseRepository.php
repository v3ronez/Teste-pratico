<?php

namespace App\Database\Repository;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class BaseRepository implements BaseRepositoryInterface
{
    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function findById(string $id)
    {
        try {
            return $this->model->find($id);
        } catch (Exception $e) {
            Log::error("Error to find by id", [$e->getMessage()]);
            return false;
        }
    }

    public function getPaginate(int $perPage = 10, int $page = 1)
    {
        return $this->model->query()->whereNull('deleted_at')->paginate($perPage, ['*'], 'page', $page);
    }

    public function create(array $attributes)
    {
        try {
            return $this->model->create($attributes);
        } catch (Exception $e) {
            Log::error("Error to create on DB", [$e->getMessage()]);
            return false;
        }
    }

    public function updateById(string $id, array $newValues)
    {
        try {
            $row = $this->findById($id);
            if (!$row) {
                return $row;
            }
            return $row->update($newValues);
        } catch (Exception $e) {
            Log::error("Error to update on DB", [$e->getMessage()]);
            return false;
        }
    }

    public function delete(string $id)
    {
        try {
            $row = $this->findById($id);
            if (!$row) {
                return $row;
            }
            return $row->delete();
        } catch (Exception $e) {
            Log::error("Error to delete on DB", [$e->getMessage()]);
            return false;
        }
    }
}
