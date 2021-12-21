<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

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
            'identity' => ['required', 'string', Rule::in(['1','0'])],
            'company_address' => Rule::requiredIf($request->identity == "1"),
            'company_phone' => Rule::requiredIf($request->identity == "1"),
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        if($request->hasFile('profile_image')){
            $profile_image = [
                'original_name' => $request->file('profile_image')->getClientOriginalName(),
                'server_path' => $request->file('profile_image')->store('/profile_images', ['disk' => 'public']),
            ];
        }

        $user = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'identity' => $request->identity,
            'company_address' => $request->company_address,
            'company_phone' => $request->company_phone,
            'password' => Hash::make($request->password),
            'profile_image'=>$profile_image,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
