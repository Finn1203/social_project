<?php
namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Post\PostRepository;

class PostService
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getUserPosts($userId)
    {
        return $this->postRepository->getPostsByUserId($userId);
    }

    public function getPublicPosts()
    {
        return $this->postRepository->getPublicPosts();
    }

    public function createPost($data, $user)
    {
        if (isset($data['image'])) {
            $image = $data['image'];
            $path = $image->store('post_images');
            $data['image'] = $path;
        }

        $data['user_id'] = $user->id;

        $post = $this->postRepository->create($data);

        broadcast(new \App\Events\PostEvent($post));

        return $post;
    }

    public function updatePost($post, $data)
    {
        if (isset($data['image'])) {
            // Handle image update logic if needed
        }

        return $this->postRepository->update($post->id, $data);
    }

    public function deletePost($post)
    {
        return $this->postRepository->delete($post->id);
    }
}
