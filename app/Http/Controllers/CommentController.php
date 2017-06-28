<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function postComment($id, Request $request)
    {
        $newsId = $id;
        $userId = Auth::user()->id;

        $addRequest = [
            'news_id' => $newsId,
            'user_id' => $userId,
        ];

        $comment = new Comment;

        if ($comment->create($request->all() + $addRequest)) {
            return back()->with('notice', trans('messages.comment_success'));
        } else {
            return back()->with('notice_error', trans('messages.comment_error'));
        }

    }
}
