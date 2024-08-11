<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Services\LikeService;
use App\Services\CommentService;
use App\Http\Controllers\Controller;

class LikeCommentController extends Controller
{
    protected $likeService;
    protected $commentService;

    public function __construct(LikeService $likeService, CommentService $commentService)
    {
        $this->likeService = $likeService;
        $this->commentService = $commentService;
    }

    public function postComment(Request $request)
    {
        $request->validate([
            'post_id' => 'required',
            'content' => 'required|min:1|max:250'
        ]);

        $comment = $this->commentService->createComment($request->user(), $request->all());

        broadcast(new \App\Events\CommentEvent($comment))->toOthers();

        return response()->json($comment);
    }

    public function likeUnlike(Request $request, $postId)
    {
        $data = $this->likeService->toggleLike($request->user(), $postId);

        broadcast(new \App\Events\LikeEvent($data));

        return response()->json([], 200);
    }
}
