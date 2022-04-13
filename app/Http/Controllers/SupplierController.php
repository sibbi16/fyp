<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation;

class SupplierController extends Controller
{
    public function index()
    {
        $data=[
            'suppliers'=> User::where('company_id', auth()->user()->id)->get(),
        ];
        return view('dashboard.suppliers.index',$data);
    }

    public function create()
    {
        return view('dashboard.suppliers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fname'=> ['required','string','max:255'],
            'lname'=> ['required','string','max:255'],
            'email'=> ['required','string','email','unique:users,email','max:255'],
            'phone'=> ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
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
            'company_id'=> auth()->user()->id,
            'username'=>Str::slug($request->fname. " " .$request->lname),
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'type' => 3,
            'password' => Hash::make($request->password),
            'profile_image'=>$profile_image ?? null,
        ]);
        if($user['type'] == 3){
            $user->assignRole('supplier');
        }
        if($user){
            return redirect()->route('dashboard.suppliers.index')->withSuccessMessage('Supplier Created Successfully');
         }
         else{
             return redirect()->route('dashboard.users.index')->withErrorMessage('An Error Has Occured');;
         }
    }

    public function show(User $supplier)
    {
        $data =[
            'supplier' => $supplier,
            // 'company' => $supplier->company_id()->first(),
        ];
        // dd($data['supplier']);
        return view('dashboard.suppliers.show' ,$data);
    }

    public function edit(User $supplier)
    {
        $data =[
            'supplier' => $supplier,
        ];
        return view('dashboard.suppliers.edit' , $data);
    }

    public function update(Request $request ,User $supplier)
    {
        $request->validate([
            'fname'=> ['required','string','max:255'],
            'lname'=> ['required','string','max:255'],
            'email'=> ['required','string','email','max:255',Rule::unique('users')->ignore($supplier->id)],
            'phone'=> ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,jpg,png'],
        ]);

        $update = $supplier->update([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'company_id'=> auth()->user()->id,
            'username'=>Str::slug($request->fname. " " .$request->lname),
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password) ?? $supplier->password,
            'profile_image'=>$profile_image ?? null,
        ]);
        if($update){
            return redirect()->route('dashboard.suppliers.index')->withSuccessMessage('Supplier Updated Successfully');
        }else{
            return redirect()->route('dashboard.suppliers.index')->withErrorMessage('AN Error Occured');
        }
    }

    public function destroy(User $supplier)
    {
        $delete = $supplier->delete();
        if($delete){
            return redirect()->route('dashboard.suppliers.index')->withSuccessMessage('Supplier Deleted Successfully');
        }else{
            return redirect()->route('dashboard.suppliers.index')->withErrorMessage('AN Error Occured');
        }
    }
}
