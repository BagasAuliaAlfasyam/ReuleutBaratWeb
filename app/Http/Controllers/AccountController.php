<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AccountController extends Controller
{
    public function index() {
        $data = [
            'users' => User::all()
        ];

        return view('home.account.index', $data);
    }

    /**
     *  Function for show detail account page
     * 
     */
    public function show() {}

    /**
     *  Function for show create account page
     * 
     */
    public function create() {
        return view('home.account.create');
    }

    /**
     *  Function for add account
     * 
     */
    public function store(Request $request) {
        try {
            $validatedData = $request->validate([
                'fullname'      => 'required',
                'username'      => 'required',
                'email'         => 'required|email',
                'password'      => 'required',
                'phone'         => 'required',
                'address'       => 'required',
                'role'          => 'required|boolean'
            ]);

            if(isset($request->user_images)) {
                $validatedData = $request->validate([
                    'user_images' => 'required|image'
                ]);
                
                $fileName = 'user-' . now()->format('d-M-Y') . time() . '.' . $request->file('user_images')->getClientOriginalExtension();

                $request->file('user_images')->storeAs('uploads/images', $fileName);
                $validatedData['user_images'] = $fileName;
            }

            $validatedData['password'] = bcrypt($validatedData['password']);
            $validatedData['role'] = $request->boolean('role');
    
            User::create($validatedData);
    
            return redirect('/accounts')->with('success', 'Add account successfully!');
        } catch (QueryException) {
            return redirect()->back()->with('error', 'Account failed to add');
        }
    }

    /**
     *  Function for show edit account page
     * 
     */
    public function edit($username) {
        $user = User::firstWhere('username', $username);
        return view('home.account.edit', compact('user'));
    }

    /**
     *  Function for update account data
     * 
     */
    public function update(Request $request, $id) {
        try {
            $user = User::findOrFail($id);
    
            $validatedData = $request->validate([
                'fullname'  => 'required',
                'username'  => 'required',
                'email'     => 'required|email',
                'phone'     => 'required',
                'address'   => 'required',
                'role'      => 'boolean'
            ]);

            if(isset($request->user_images)) {
                $validatedData = $request->validate([
                    'user_images' => 'required|image'
                ]);
                if($request->old_img) {
                    Storage::delete('uploads/images/'.$request->old_img);
                }
                
                $filename = 'user-' . now()->format('d-M-Y') . time() . '.' . $request->file('user_images')->getClientOriginalExtension();

                $request->file('user_images')->storeAs('uploads/images', $filename);
                $validatedData['user_images'] = $filename;
            }

            $validatedData['role'] = $request->boolean('role');
            $user->update($validatedData);
            return redirect('/accounts')->with('success', 'Updated account data successfully!');
        } catch (QueryException) {
            return redirect()->back()->with('error', 'Update account data failed!');
        }
    }

    /**
     *  Function for delete account user
     * 
     */
    public function destroy($id) {
        try {
            User::findOrFail($id)->delete();
            return redirect()->back()->with('success', 'Deleted account successfully!');
        } catch (QueryException) {
            return redirect()->back()->with('error', 'Delete account failed!');
        }
    }

    /**
     *  Function for show change password page
     * 
     */
    public function changePassword($username) {
        $user = User::firstWhere('username', $username);
        return view('home.account.change-password', compact('user'));
    }

    /**
     *  Function for update new password user
     * 
     */
    public function updatePassword(Request $request, $id) {
        $request->validate([
            'current_password' => 'required|current_password',
            'password'         => 'required|password|confirmed'
        ]);

        $user = User::findOrFail($id);
        if(Hash::check($request->current_password, $user->password)) {
            $user->update(['password' => Hash::make($request->password)]);
            return redirect('/accounts');
        }
        throw ValidationException::withMessages([
            'current_password' => 'Your current password not match!'
        ]);
    }
}