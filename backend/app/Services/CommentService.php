<?php
namespace App\Services;

use App\Models\Post;
use App\Models\User;
use App\Notifications\CommentNotification;
use App\Repositories\Comment_Like\CommentRepository;

class CommentService
{
    protected $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function createComment($user, $data)
    {
        $comment = $this->commentRepository->create([
            'user_id' => $user->id,
            'post_id' => $data['post_id'],
            'content' => $data['content'],
        ]);
        $comment->load('user:id,first_name,last_name');

        $post = Post::find($data['post_id']);
        $postUser = User::find($post->user_id);
        $title = $user->first_name .' '. $user->last_name. ' Commented on your post.';
        $postUser->notify(new CommentNotification($title, $post));

        return $comment;
    }
}
