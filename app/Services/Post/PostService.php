<?php
namespace App\Services\Post;

use Exception;
use App\Models\Post;
use App\Events\PostCreated;
use Illuminate\Support\Facades\Auth;

class PostService
{
    public function get($id)
    {
        return Post::with('author')->findOrFail($id);
    }

    public function store($request)
    {
        $data = $request->all();
        
        $post = Post::create($data);
        $post->load('author');
        event(new PostCreated($post));

        return $post;
    }

    public function update($request, $id)
    {
        $data = $request->all();

        $post = Post::find($id);

        if (!$post) {
            throw new Exception('Post not found');
        }

        $post->update($data);

        return $post;
    } 
}