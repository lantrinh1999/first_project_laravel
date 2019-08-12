<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    protected $_data = [];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $users = Comment::all();
        $comments = DB::table('products')
        ->select('comments.product_id', 'comments.user_id', 'comments.id as comment_id', 'users.name as user_name', 'comments.content', 'comments.created_at', 'products.name as product_name')
        ->join('comments', 'products.id', '=', 'comments.product_id')
        ->join('users', 'comments.user_id', '=', 'users.id')
        ->get()->toArray();
        // dd($comments);
        $this->_data['comments'] = $comments;

        return view('comment.list', $this->_data);
    }

    public function delete($id)
    {
        $comment = Comment::find($id);
        $check = $comment->delete();
        if ($check) {
            return redirect()->route('admin.comment.list')->with('success', 'Xoá comment thành công!');
        } else {
            return redirect()->route('admin.comment.list')->with('error', 'Xoá Không Thành công comment thành công!');
        }
    }
}
