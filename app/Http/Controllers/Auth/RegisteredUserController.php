<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'=>['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', Rule::in(['1','2','3'])],
            'company_name' =>  Rule::requiredIf($request->type == "1"),
            'company_address' => Rule::requiredIf($request->type == "1"),
            'company_phone' =>  Rule::requiredIf($request->type == "1"),
            'company_landline' => Rule::requiredIf($request->type == "1"),
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        if($request->hasFile('profile_image')){
            $profile_image = [
                'original_name' => $request->file('profile_image')->getClientOriginalName(),
                'server_path' => $request->file('profile_image')->store('profile_images', ['disk' => 'public']),
            ];
        }

        $user = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'username'=> Str::slug($request->fname. " " .$request->lname),
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'type' => $request->type,
            'company_name' => $request->company_name,
            'company_address' => $request->company_address,
            'company_phone' => $request->company_phone,
            'company_landline' => $request->company_landline,
            'password' => Hash::make($request->password),
            'profile_image'=>$profile_image ?? Null,
        ]);
        if($request->type == "1"){
            $user->assignRole('company');
        }
        elseif($request->type == "2"){
            $user->assignRole('shopkeeper');
        }
        elseif($request->type == "3"){
            $user->assignRole('supplier');
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
