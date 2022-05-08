<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string'],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        $user = User::where('email',$request->email)->first();
        if(!$user || !Hash::check($request->password , $user->password)){
            return response([
                'Incorrect Data'
            ] , 401);
        }

        $token =$user->createToken('my_app_token')->plainTextToken;

        $data=[
            'user'=>$user,
            'token'=>$token
        ];
        return response($data,201);
    }

    public function store(Request $request)
    {
        $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'=>['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'username'=> Str::slug($request->fname. " " .$request->lname),
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'type' => 2,
            'password' => Hash::make($request->password),
            'profile_image'=> Null,
        ]);
        $token =$user->createToken('my_app_token')->plainTextToken;
        $user->assignRole('shopkeeper');
        $data=[
            'user'=>$user,
            'token'=>$token
        ];
        return response($data,201);
    }

    public function destroy()
    {
        auth()->user()->tokens()->delete();
        return [
            'message' => 'Logged out'
        ];
    }


}
