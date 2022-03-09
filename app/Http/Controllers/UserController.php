<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $data=[
            'users'=> User::all(),
        ];
        return view('dashboard.users.index'  , $data);
    }
    public function create()
    {

    }

    public function store()
    {

    }

    public function show(User $user)
    {
        $data=[
            'user' =>$user,
        ];
        return view('dashboard.users.show',$data);
    }
}
