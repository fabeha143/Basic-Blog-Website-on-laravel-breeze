<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::where('user_id', auth()->id())
                 ->latest()
                 ->get();

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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'published' => 'boolean',
        ]);
    
        $validated['slug'] = Str::slug($validated['title']);
        $validated['user_id'] = auth()->id();
    
        Post::create($validated);
    
        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
            // Ensure the authenticated user owns the post
        if ($post->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // Ensure the authenticated user owns the post
        if ($post->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        return view('posts.edit', compact('post'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, POst $post)
    {
        // Make sure only the owner can update
        if ($post->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        // Manually retrieve input values
        $data = [
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'published' => $request->has('published'), // Checkbox returns boolean
            'slug' => Str::slug($request->input('title')),
        ];

        $post->update($data);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }
    
        $post->delete();
    
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
