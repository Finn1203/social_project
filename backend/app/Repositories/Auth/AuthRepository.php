<?php
namespace App\Repositories\Auth;

use App\Models\User;
use App\Repositories\BaseRepository;

class AuthRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function findByEmail($email)
    {
        return $this->model->where('email', $email)->first();
    }

    public function findByEmailAndCode($email, $code)
    {
        return $this->model->where('email', $email)->where('remember_token', $code)->first();
    }
}
