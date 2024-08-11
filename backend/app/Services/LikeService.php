<?php
namespace App\Services;

use App\Models\Post;
use App\Models\User;
use App\Notifications\LikeNotifcation;
use App\Repositories\Comment_Like\LikeRepository;

class LikeService
{
    protected $likeRepository;

    public function __construct(LikeRepository $likeRepository)
    {
        $this->likeRepository = $likeRepository;
    }

    public function toggleLike($user, $postId)
    {
        $exists = $this->likeRepository->findByUserIdAndPostId($user->id, $postId);

        if ($exists) {
            $type = 'unlike';
            $exists->delete();
            $like = null;
        } else {
            $type = 'like';
            $like = $this->likeRepository->create([
                'user_id' => $user->id,
                'post_id' => $postId,
            ]);

            $post = Post::find($postId);
            $postUser = User::find($post->user_id);
            $title = $user->first_name .' '. $user->last_name. ' Liked your post.';
            $postUser->notify(new LikeNotifcation($title, $post));
        }

        return [
            'type' => $type,
            'like' => $like,
        ];
    }
}
