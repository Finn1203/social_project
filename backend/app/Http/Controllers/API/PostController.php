<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Services\PostService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index(Request $request)
    {
        $posts = $this->postService->getUserPosts($request->user()->id);
        return response()->json($posts);
    }

    public function publicPosts()
    {
        $posts = $this->postService->getPublicPosts();
        return response()->json($posts);
    }

    public function store(StorePostRequest $request)
    {
        $post = $this->postService->createPost($request->validated(), $request->user());

        return response()->json([
            'message' => 'Post Created',
            'data' => $post
        ]);
    }

    public function show(Post $post)
    {
        // Logic for showing a specific post if needed
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $post = $this->postService->updatePost($post, $request->validated());
        return response()->json($post);
    }

    public function destroy(Post $post)
    {
        $this->postService->deletePost($post);

        return response()->json([
            'message' => "Post deleted successfully",
        ]);
    }
}
