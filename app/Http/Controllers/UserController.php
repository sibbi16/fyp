<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        return view('dashboard.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fname'=>['required','string','max:255'],
            'lname'=>['required','string','max:255'],
            'email'=>['required','string','email','unique:users,email','max:255'],
            'phone'=>['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', Rule::in(['1','2','3'])],
            'company_address' => Rule::requiredIf($request->type == "1"),
            'company_phone' => Rule::requiredIf($request->type == "1"),
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if($request->hasFile('profile_image')){
            $profile_image = [
                'original_name' => $request->file('profile_image')->getClientOriginalName(),
                'server_path' => $request->file('profile_image')->store('profile_images', ['disk' => 'public']),
            ];
        }else{
            $profile_image= null;
        }
        $user = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'username'=>Str::slug($request->fname. " " .$request->lname),
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'type' => $request->type,
            'company_address' => $request->company_address,
            'company_phone' => $request->company_phone,
            'password' => Hash::make($request->password),
            'profile_image'=>$profile_image ?? null,
        ]);
        if($request->type == "1"){
            $user->assignRole('company');
        }
        elseif($request->type == "2"){
            $user->assignRole('individual');
        }
        elseif($request->type == "3"){
            $user->assignRole('shopkeeper');
        }
        if($user){
            return redirect()->route('dashboard.users.index');
        }
        else{
            return redirect()->route('dashboard.users.index');
        }
    }

    public function show(User $user)
    {
        $data=[
            'user' =>$user,
        ];
        return view('dashboard.users.show',$data);
    }
}
