<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Services\Post\PostService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        $posts = Post::with('author')->get();
        return view('Post.index', compact('posts'));
    }

    public function show($id)
    {
        try {
            $post = $this->postService->get($id);
            return view('Post.show', compact('post'));
        } catch (\Exception $e) {
            return redirect()->route('posts.index')->with('error', $e->getMessage());
        }
    }

    public function create()
    {
        $authors = User::all();
        return view('Post.create', compact('authors'));
    }

    public function store(PostRequest $request)
    {
        try {
            DB::beginTransaction();

            $post = $this->postService->store($request);

            DB::commit();
            return redirect()->route('posts.index')->with('success', 'Post created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $post = $this->postService->get($id);
            $authors = User::all();
            return view('Post.edit', compact('post', 'authors'));
        } catch (\Exception $e) {
            return redirect()->route('posts.index')->with('error', 'Post not found');
        }
    }

    public function update(PostRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $post = $this->postService->update($request, $id);

            DB::commit();
            return redirect()->route('posts.index')->with('success', 'Post updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->delete();
            return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('posts.index')->with('error', 'Post not found');
        }
    }
}
