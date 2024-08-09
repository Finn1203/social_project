<?php
namespace App\Repositories\Post;

use App\Models\Post;
use App\Repositories\BaseRepository;

class PostRepository extends BaseRepository
{
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }

    public function getPostsByUserId($userId)
    {
        return $this->model->with(['user:id,first_name,last_name', 'comments.user:id,first_name,last_name', 'likes.user:id,first_name,last_name'])
                            ->withCount(['likes', 'comments'])
                            ->where('user_id', $userId)
                            ->orderBy('created_at', 'desc')
                            ->cursorPaginate();
        // return $this->model->with([['user:id','first_name','last_name']])
        //                    ->where('user_id', $userId)
        //                    ->orderBy('created_at', 'desc')
        //                    ->cursorPaginate();
    }

    public function getPublicPosts()
    {
        return $this->model->with(['user:id,first_name,last_name', 'comments.user:id,first_name,last_name', 'likes.user:id,first_name,last_name'])
                            ->withCount(['likes', 'comments'])
                            ->where('visibility', 'public')
                            ->orderBy('created_at', 'desc')
                            ->cursorPaginate();
    }
}
