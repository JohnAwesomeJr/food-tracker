<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::select('id', 'title','image')->get();
        return view('posts.index', ['posts' => $posts]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(PostRequest $request)
    {
        $post = new Post;
        $post->title = $request->input('title');
        $post->content = $request->input('content');

        // Check if an image file was uploaded
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Store the uploaded image in the "public" disk using a unique name
            $imageName = uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->image->storeAs('public', $imageName);

            // Set the post's image filename attribute
            $post->image = $imageName;
        }

        $post->save();

        return redirect()->route('posts.index');
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', ['post' => $post]);
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', ['post' => $post]);
    }

    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->title = $request->input('title');
        $post->content = $request->input('content');

        // Check if an image file was uploaded
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Delete the old image file
            Storage::delete('public/' . $post->image);

            // Store the uploaded image in the "public" disk using a unique name
            $imageName = uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->image->storeAs('public', $imageName);

            // Set the post's image filename attribute
            $post->image = $imageName;
        }

        $post->save();

        return redirect()->route('posts.index');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // Delete the post's image file, if it exists
        if ($post->image) {
            Storage::delete('public/' . $post->image);
        }

        $post->delete();

        return redirect()->route('posts.index');
    }
}
