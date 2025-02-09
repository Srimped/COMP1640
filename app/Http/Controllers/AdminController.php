<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Enum;

class AdminController extends Controller
{
    //
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        return Auth::guard('admin')->attempt($credentials)
            ? redirect()->route('admin.index')
            : redirect()->route('Goodi.login');
    }

    public function index()
    {
        return Auth::guard('admin')->check()
            ? to_route('admin.index')
            : to_route('Goodi.login');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/login');
    }

    public function acc()
    {
        $users = User::all();
        return view('Goodi.admin.acc', ['users' => $users]);
    }

    public function createAcc(Request $request)
    {
        $request['password'] = Hash::make($request['password']);
        $input = $request->all();
        User::create($input);
        return redirect('admin/acc')->with('success', 'Create Successful!!!!!');
    }

    public function showAcc($id)
    {
        $account = User::find($id);
        return view('Goodi/admin/showAcc')->with('account', $account);
    }
    public function editAcc($id)
    {
        $account = User::find($id);
        return view('Goodi/admin/editAcc')->with('account', $account);
    }
    public function updateAcc(Request $request)
    {
        $input = $request->all();
        $id = $request->id;
        User::find($id)->update($input);
        return redirect('admin/acc')->with('success', 'account updated successfully');
    }
    public function deleteAcc($id)
    {
        $account = User::find($id);
        return view('Goodi/admin/deleteAcc')->with('account', $account);
    }

    public function delete($id)
    {
        $account = User::find($id);
        dd($account);
        User::find($id)->delete();
        return redirect('admin/acc')->with('success', 'account deleted successfully');
    }
}
