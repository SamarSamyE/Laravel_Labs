<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;


class PostController extends Controller
{

    public function index()
    {
        // $allPosts = Post::all();
        $allPosts = Post::paginate(10);
        return view('post.index', ['posts' => $allPosts]);
    }

    public function show($id)
    {
        // $postCollection = Post::where('id', $id)->get();
        $post = Post::where('id', $id)->first();
        $comments=$post->comments;
        // dd($comments);
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
public function update(Request $request, $id)
{
    $post = Post::find($id);

    $post->title = $request->input('title');
    $post->description = $request->input('description');
    $post->save();

    return redirect()->route('posts.index');
}

    public function store(Request $request)
    {
        $title = request()->title;
        $description = request()->description;
        $postCreator = request()->post_creator;
        Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $postCreator,
        ]);

        return to_route('posts.index');
    }

    public function destroy(Request $request, $id)
{
    $post = Post::findOrFail($id);
    $post->delete();
    return redirect()->route('posts.index');
}

}


