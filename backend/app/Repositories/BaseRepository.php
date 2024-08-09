<?php
namespace App\Repositories;

use App\Repositories\BaseRepositoryInterface ;
use Illuminate\Database\Eloquent\Model;


class BaseRepository implements BaseRepositoryInterface
{
    protected $model;
    public function __construct($model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function findById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, $data)
    {
        $object = $this->findById($id);
        if ($object) {
            $object->update($data);
            return $object;
        }
        return null;
    }

    public function delete($id)
    {
        $model = $this->model->findOrFail($id);
        if ($model) {
            $model->delete();
            return true;
        }
        return false;
    }

    public function paginate($perPage)
    {
        return $this->model->paginate($perPage);
    }

    public function search($query)
    {
        return $this->model->where('name', 'LIKE', '%'. $query. '%')->get();
    }
}
