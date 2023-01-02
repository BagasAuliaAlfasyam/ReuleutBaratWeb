<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function index()
    {
        $data = User::firstWhere('id', Auth()->user()->id);
        $active = 'profile';
        return view('home.profile.index', compact('data', 'active'));
    }
    public function update(Request $request)
    {
        try{
            $request->validate([
                'fullname' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'address' => 'required',
            ]);

            auth()->user()->update($request->all());

            return redirect('/profile')->with('success', 'Image has been updated successfully!');
        }catch (QueryException){
            return redirect()->back()->with('error', 'Server tidak merespon!');
        }
    }

    public function password(Request $request, $id)
    {
        $user = User::findOrFail($id);
        try {
            $request->validate([
                'current_password' => 'required',
                'password' => 'required|confirmed|min:8',
            ]);
            $user->password = bcrypt($request->password);
            $user->save();
            return redirect()->back()->with('success', 'Password has been updated successfully!');
        } catch (QueryException $th) {
            return redirect()->back()->with('error', 'Server tidak merespon!');
        }
    }

    public function changeImage(Request $request, $id) 
    {
        try {
            $request->validate([
                'user_images' => 'required|image|file|max:5020|mimes:jpg,png',
            ]);
            $fileName = Auth()->user()->username . now()->format('d-M-Y') . time() . '.' . $request->file('user_images')->getClientOriginalExtension();
            $request->file('user_images')->move("storage/uploads/images", $fileName);
            $user = User::findOrFail($id);
            $user->user_images = $fileName;
            $user->save(); 

            return redirect('/profile')->with('success', 'Image has been updated successfully!');
        } catch (QueryException) {
            return redirect()->back()->with('error', 'paok');
        }
    }
}
