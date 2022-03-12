<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
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
            'fname'=> ['required','string','max:255'],
            'lname'=> ['required','string','max:255'],
            'email'=> ['required','string','email','unique:users,email','max:255'],
            'phone'=> ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', Rule::in(['1','2','3'])],
            'company_name' => ['required','string', Rule::requiredIf($request->type == "1")],
            'company_address' => ['required','string',Rule::requiredIf($request->type == "1")],
            'company_phone' => ['required','string', Rule::requiredIf($request->type == "1")],
            'company_landline' => ['required','string',Rule::requiredIf($request->type == "1")],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,jpg,png'],
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
            'company_name' => $request->company_name,
            'company_address' => $request->company_address,
            'company_phone' => $request->company_phone,
            'company_landline' => $request->company_landline,
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
           return redirect()->route('dashboard.users.index')->withSuccessMessage('User Created Successfully');
        }
        else{
            return redirect()->route('dashboard.users.index')->withErrorMessage('An Error Has Occured');;
        }
    }

    public function show(User $user)
    {
        $data=[
            'user' =>$user,
        ];
        return view('dashboard.users.show',$data);
    }

    public function edit(User $user)
    {
        $data=[
            'user'=>$user,
        ];
        return view('dashboard.users.edit' ,$data);
    }

    public function update(User $user, Request $request)
    {
         $request->validate([
            'fname'=>['required','string','max:255'],
            'lname'=>['required','string','max:255'],
            'email'=>['required','string','email','max:255'],
            'phone'=>['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'company_name' => ['required','string', Rule::requiredIf($request->type == "1")],
            'company_address' => ['required','string',Rule::requiredIf($request->type == "1")],
            'company_phone' => ['required','string', Rule::requiredIf($request->type == "1")],
            'company_landline' => ['required','string',Rule::requiredIf($request->type == "1")],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png.jpg'],
        ]);

        if($request->hasFile('profile_image')){
            $profileImage = [
                'original_name' => $request->file('profile_image')->getClientOriginalName(),
                'server_path' => $request->file('profile_image')->store('profile_images', ['disk' => 'public']),
            ];

            if($user->profile_image){
                Storage::disk('public')->delete($user->profile_image['server_path']);
            }
        }


       $updated = $user->update([
        'fname' => $request->fname,
        'lname' => $request->lname,
        'username'=>Str::slug($request->fname. " " .$request->lname),
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->address,
        'type' => $request->type,
        'company_name' => $request->company_name,
        'company_address' => $request->company_address,
        'company_phone' => $request->company_phone,
        'company_landline' => $request->company_landline,
        'profile_image'=>$profileImage ?? null,
       ]);
       if($updated){
           return redirect()->route('dashboard.users.show',$user)->withSuccessMessage('User Updated Successfully');;
       }
       else{
        return redirect()->route('dashboard.users.show',$user)->withErrorMessage('An Error Occured');
       }
    }

    public function destroy(User $user)
    {
        if($user->profile_image){
            Storage::disk('public')->delete($user->profile_image['server_path']);
        }
        if($user->id == 1){
            return redirect()->route('dashboard.users.index')->withWarningMessage('You Can Not Delete Administrator');
        }
        else{
            $userDeleted = $user->delete();
        }
        if($userDeleted){
            return redirect()->route('dashboard.users.index')->withSuccessMessage('User Deleted Successfully');
        }
        else{
            return redirect()->route('dashboard.users.index')->withErrorMessage('Sorry an Error has occured');
        }
    }
}
