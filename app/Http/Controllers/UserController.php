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
}
