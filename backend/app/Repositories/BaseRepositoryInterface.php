<?php
namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    /**
     * get all
     * @return mixed
     */
    public function getAll();

    /**
     * Get one by id
     * @param $id
     * @return mixed
     */
    public function findById($id);

    /**
     * Update data by id
     * @param $id
     * @param $data
     * @return mixed
     */
    public function update($id, array $data);

    /**
     * Delete data by id
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * Create data
     * @param $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Search data by keyword
     * @param $keyword
     * @return mixed
     */
    public function search($keyword);

    /**
     * Paginate data
     * @param $perpage
     * @return mixed
     */
    public function paginate($perpage);
}
