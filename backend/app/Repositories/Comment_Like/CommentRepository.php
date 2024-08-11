<?php
namespace App\Repositories\Comment_Like;

use App\Models\Comment;
use App\Repositories\BaseRepository;

class CommentRepository extends BaseRepository
{
    public function __construct(Comment $model)
    {
        parent::__construct($model);
    }
}

