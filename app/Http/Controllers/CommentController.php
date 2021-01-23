<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Room;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function addRoomComment(Request $request, Room $room)
    {
        $this->validate($request,[
            'body' => 'required|string'
        ]);

        $comment = new Comment();
        $comment->body = $request->body;
        $comment->user_id = auth()->id();

        $room->comments()->save($comment);

        return redirect()->back();
    }

    public function updateRoomComment(Request $request, Comment $comment)
    {
        $this->validate($request,[
            'body' => 'required|string'
        ]);

        $comment->update($request->all());

        return redirect()->back();
    }

    public function deleteRoomComment(Comment $comment)
    {
        if(auth()->id() == $comment->user_id){
            $comment->delete();
        }
        return redirect()->back();
    }

    public function addReplyComment(Request $request, Comment $comment)
    {
        $this->validate($request,[
            'body' => 'required|string'
        ]);

        $reply = new Comment();
        $reply->body = $request->body;
        $reply->user_id = auth()->id();

        $comment->comments()->save($reply);

        return redirect()->back();
    }


    /*public function deleteReplyComment(Comment $comment)
    {
        dd($comment);
        if(auth()->id() == $comment->user_id){
            $comment->delete();
        }
        return redirect()->back();
    }*/

}
