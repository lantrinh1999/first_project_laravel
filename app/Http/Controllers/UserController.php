<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\EditUserRequest;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $_data = [];

    public function __construct()
    {
        $this->middleware(['auth', 'active.admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $this->_data['users'] = $users;

        return view('user.list', $this->_data);
    }

    public function add()
    {
        return view('user.add');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $this->_data['user'] = $user;

        return view('user.add', $this->_data);
    }

    public function saveAdd(UserRequest $request)
    {
        $data = $request->except('_token', 'confirm_password');
        $data['password'] = bcrypt($data['password']);
        $data['created_at'] = date('Y-m-d H:i:s', time());
        // dd($data);
        $check = User::insert($data);
        if ($check) {
            return redirect()->route('admin.user.list')
                        ->with('success', 'Thêm thành công ');
        } else {
            return redirect()->route('admin.user.list')
                        ->with('error', 'Thêm ko thành công');
        }
    }

    public function saveEdit(EditUserRequest $request)
    {
        $data = $request->except('_token', 'confirm_password');
        if (empty($request->password)) {
            $data = $request->except('password');
        } else {
            $data['password'] = bcrypt($data['password']);
        }
        $data['updated_at'] = date('Y-m-d H:i:s', time());
        $id = $request->id;
        $user = User::find($id);
        $check = $user->update($data);

        // dd($data);
        if ($check) {
            return redirect()->route('admin.user.list')
                        ->with('success', 'Sửa thành công ');
        } else {
            return redirect()->route('admin.user.list')
                        ->with('error', 'Sửa ko thành công');
        }
    }

    public function delete($id)
    {
        $current_uid = Auth::user()->id;
        if ($current_uid != $id) {
            $user = User::find($id);
            $check = $user->delete();
            if ($check) {
                Comment::where('user_id', '=', $id)->delete();

                return redirect()->route('admin.user.list')
                        ->with('success', "Xoa' thành công người dùng ".$user->name);
            } else {
                return redirect()->route('admin.user.list')
                        ->with('error', "Xoa' ko thành công");
            }
        } else {
            return redirect()->route('admin.user.list')
                        ->with('error', "Xoa' ko thành công");
        }
    }
}
