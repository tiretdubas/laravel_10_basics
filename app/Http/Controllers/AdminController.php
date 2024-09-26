<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.posts.index', [
            'posts' => Post::without('category', 'tags')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return $this->showForm();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post): View
    {
        return $this->showForm($post);
    }

    protected function showForm(Post $post = new Post): View
    {
        return view('admin.posts.form', [
            'post' => $post,
            'categories' => Category::orderBy('name')->get(),
            'tags' => Tag::orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request): RedirectResponse
    {
        return $this->save($request->validated());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        return $this->save($request->validated(), $post);
    }

    protected function save(array $data, Post $post = null): RedirectResponse
    {
        if (isset($data['thumbnail'])) {
            if (isset($post->thumbnail)) {
                Storage::delete($post->thumbnail);
            }
            $data['thumbnail'] = $data['thumbnail']->store('thumbnails');
        }

        $data['excerpt'] = Str::limit($data['content'], 150);

        $post = Post::updateOrCreate(['id' => $post?->id], $data);
        $post->tags()->sync($data['tag_ids'] ?? null);

        return redirect()->route('posts.show', ['post' => $post])->withStatus(
            $post->wasRecentlyCreated ? 'Post publié !' : 'Post mis à jour !'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Storage::delete($post->thumbnail);
        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}
