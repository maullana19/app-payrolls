<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return view('user_profile');
    }

    public function editUserProcess(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->position = $request->position;
            $user->id_role = $request->id_role;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/avatars'), $filename);
                $user->image = $filename;
            }

            if ($request->password) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            return redirect()->back()->with('successEditUser', 'Perubahan Berhasil Disimpan.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('errorEditUser', 'Perubahan Gagal Disimpan.');
        }
    }
}
