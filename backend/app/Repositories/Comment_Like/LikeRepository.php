<?php
namespace App\Repositories\Comment_Like;

use App\Models\Like;
use App\Repositories\BaseRepository;

class LikeRepository extends BaseRepository
{
    public function __construct(Like $model)
    {
        parent::__construct($model);
    }

    public function findByUserIdAndPostId($userId, $postId)
    {
        return $this->model->where('user_id', $userId)->where('post_id', $postId)->first();
    }
}
