<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    protected $_data;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->middleware('auth');

        return view('home');
    }

    // view đăng nhập
}
