<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function __construct()
    {
       $this->middleware(['auth', 'role:Admin']);
    }

    public function adminDashboard()
    {
        return view('admin.dashboard');
    }

    // view all customers
    public function users()
    {
        $users = User::orderBy('id', 'DESC')->get();
        return view('admin.user.all', compact('users'));
    }

    // view add user form
    public function addUser()
    {
        return view('admin.user.add');
    }

    // create a user
    public function createUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['nullable', 'numeric', 'regex:/((01)[3-9][0-9]{8})$/', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'array', Rule::in(['Admin', 'Manager', 'Support', 'Customer'])],
        ],
        [
            'phone.regex' => 'Not a valid phone number.'
        ]);
       
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'user_name' => 'UN'.Str::random(9),
        ]);

        foreach($request->role as $role)
        {
            $user->assignRole($role);
        }

        if(!in_array('Customer', $request->role))
        {
            $user->assignRole('Customer');
        }

        
        session()->flash('success', 'New User Created Successfuly!');

        return redirect()->route('allUsers');
    }

    // view single user 
    public function viewUser(User $user)
    {
        return view('admin.user.view', ['user' => $user]);
    }

    // view edit user form
    public function editUser(User $user)
    {
        return view('admin.user.edit', ['user' => $user]);
    }

    // update a user
    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['nullable', 'numeric', 'regex:/((01)[3-9][0-9]{8})$/', 'unique:users'],
            'role' => ['required', 'array', Rule::in(['Admin', 'Manager', 'Support', 'Customer'])],
        ],
        [
            'phone.regex' => 'Not a valid phone number.'
        ]);
       
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();
        $user->syncRoles($request->role);

        if(!in_array('Customer', $request->role))
        {
            $user->assignRole('Customer');
        }

        
        session()->flash('success', 'User Updated Successfuly!');

        return redirect(route('viewUser', ['user' => $user]));
    }

    // view soft deleted users
    public function viewSoftDeletedUsers()
    {
        $deletedUsers = User::onlyTrashed()->orderBy('deleted_at', 'DESC')->get();
        return view('admin.user.trashedUsers', compact('deletedUsers'));
    }

    // soft deleting a user
    public function softDeleteUser(User $user)
    {
        $user->delete();
        session()->flash('success', 'User Deleted Successfuly!');
        return redirect(route('allUsers'));
    }

    // restoring a soft deleted user
    public function restoreUser($id)
    {
        $user = User::withTrashed()->find($id);
        $user->restore();
        session()->flash('success', 'User Restored Successfuly!');
        return redirect()->route('allUsers');
    }

    // permanently delete a user
    public function permanentDeleteUser($id)
    {
        $user = User::withTrashed()->find($id);
        $user->forceDelete();
        session()->flash('success', 'User Permanently Deleted Successfuly!');
        return redirect()->route('allUsers');
    }



}
