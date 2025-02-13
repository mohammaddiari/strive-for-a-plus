<?php

namespace App\Http\Controllers;

use App\Enums\Level;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort = $request->query('sort', 'latest');

        $posts = Post::query();

        if ($sort === 'tutor') {
            $posts->orderBy('user_id');
        } elseif ($sort === 'level') {
            $posts->orderBy('level');
        } else {
            $posts->orderBy('created_at', 'desc');
        }

        $posts = $posts->get();

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'subject' => 'required|string',
            'price' => 'required|numeric|min:0',
            'level' => [Rule::enum(Level::class)],
            'capacity' => 'required|integer|min:1',
            'image' => 'nullable|image',
        ]);

        if ($request->has('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = uniqid() . '.' . $extension;
            $path = 'images/posts/';

            $file->move($path, $filename);
            $validated['image'] = $path . $filename;
        }

        $request->user()->posts()->create($validated);
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post): View
    {
        Gate::authorize('update', $post);

        return view('posts.edit', [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post): RedirectResponse
    {
        Gate::authorize('update', $post);

        $validated = $request->validate([
            'subject' => 'required|string',
            'price' => 'required|numeric|min:0',
            'level' => [Rule::enum(Level::class)],
            'capacity' => 'required|integer|min:1',
            'image' => 'nullable|image',
        ]);

        if ($request->has('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = uniqid() . '.' . $extension;
            $path = 'images/posts/';

            if (File::exists($post->image)) {
                File::delete($post->image);
            }

            $file->move($path, $filename);
            $validated['image'] = $path . $filename;
        }

        $post->update($validated);

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
