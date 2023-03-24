<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\User;
use App\Models\Post;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;



class PostController extends Controller
{

    public function index()
    {
        $allPosts = Post::paginate(10);
        return view('post.index', ['posts' => $allPosts]);
    }

    public function show($id)
    {

        $post = Post::where('id', $id)->first();
        $comments=$post->comments;
        return view('post.show', ["comments"=>$comments],['post' => $post]);
    }

    public function create()
    {
        $users = User::all();
        return view('post.create', ['users' => $users]);
    }
    public function edit($id)
{
    $post = Post::find($id);
    return view('post.edit', compact('post'));
}
public function update(StorePostRequest $request, $id)
{
    // $post = Post::findOrFail($id);
    $post = Post::find($id);
    $post->title = $request->input('title');
    $post->description = $request->input('description');


    if ($request->hasFile('image')) {
        if ($post->image_path) {
            $imagePath=$post->image_path;
            Storage::delete('public/'.$imagePath);
        }
        $image = request()->file('image');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('public/', $filename);
        $post->image_path = $filename;
        // $path = Storage::putFileAs('posts', $image, $filename);
        // $post->image_path = $path;
    }
    $post->save();
    return redirect()->route('posts.index');
}

    public function store(StorePostRequest $request)
    {
        $post=new Post();
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->user_id = $request->input('post_creator');

        if ($request->hasFile('image')) {
            $image = request()->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public', $filename);
            $post->image_path = $filename;
        }
        $post->save();

        return to_route('posts.index');
    }

    public function destroy(Request $request, $id)
{
    $post = Post::findOrFail($id);
    if ($post->image_path) {
        $imagePath=$post->image_path;
        Storage::delete('public/'.$imagePath);
    }
    $post->delete();
    return redirect()->route('posts.index');
  }
}


