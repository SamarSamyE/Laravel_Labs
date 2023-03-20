<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
class CommentController extends Controller
{
   public function store(Request $request,$id)
    {
        $post= Post::find($id);

         $comment = request()->comment;
        $post->comments()->create([
            'comment' => $comment,
          ]);
        return redirect()->back()->with('success', 'Comment added.');
    }
    public function destroy(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return redirect()->back();
    }
}
