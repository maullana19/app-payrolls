<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admins.dashboard');
    }

    public function dataUser()
    {
        $dataRole = Role::all();
        $dataUsers = User::all();
        return view('admins.user_data', compact('dataUsers', 'dataRole'));
    }

    public function addUserProcess(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'position' => 'required',
                'password' => 'required',
                'id_role' => 'required',
            ]);

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->position = $request->position;
            $user->password = $request->password;
            $user->id_role = $request->id_role;
            $user->image = $request->image;
            $user->save();

            return redirect()->back()->with('success', 'User added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add user: ' . $e->getMessage());
        }
    }

    public function editUser(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'position' => 'required',
                'id_role' => 'required',
            ]);

            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->position = $request->position;
            $user->id_role = $request->id_role;
            $user->image = $request->image;
            $user->save();

            return redirect()->back()->with('success', 'User updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update user: ' . $e->getMessage());
        }
    }


    public function deleteUser($id)
    {
        try {
            $user = User::find($id);
            $user->delete();
            return redirect()->back()->with('success', 'User deleted successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to delete user: ' . $th->getMessage());
        }
    }
}
