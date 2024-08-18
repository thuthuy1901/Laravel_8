<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\c;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.users.login', [
            'title' => 'Login'
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email:filter',
            'password' => 'required'
        ]);
        $email = $request->input('email');
        $userActive = User::where('email', $email)->value('active');
        if ($userActive == 1) {
            if (Auth::attempt([
                'email' => $email,
                'password' => $request->input('password'),
            ], $request->input('remember'))) {
                return redirect()->route('admin');
            }
            Session::flash('error', 'Email or password wrong!');
        } else {
            Session::flash('error', 'Tài khoản chưa được kích hoạt!');
        }

        return redirect()->back();
    }

    public function register()
    {
        return view('admin.users.register', [
            'title' => 'Register'
        ]);
    }

    public function upRegister(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email:filter',
            'password' => 'required'
        ]);
        $email = $request->input('email');
        $users = User::where('email', $email)->first();
        if (!$users) {
            try {
                User::create([
                    'email' => (string) $email,
                    'active' => 0,
                    'password' => (string) bcrypt($request->input('password')),
                    'name' => (string) strstr($email, '@', true)
                ]);
                Session::flash('success', 'Đợi admin add bạn!');
            } catch (\Exception $error) {
                Session::flash('error', 'Đăng ký thất bại');
            }
        } else {
            Session::flash('error', 'Email đã tồn tại');
        }
        return redirect()->back();
    }

    public function list()
    {
        $users = User::paginate(8);
        return view('admin.users.list', [
            'title' => 'Danh sách đăng nhập',
            'users' => $users
        ]);
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        return view('admin.users.edit', [
            'title' => 'Cập nhập User',
            'user' => $user
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
        ]);

        $user = User::find($id);
        $user->fill($request->input());
        $user->save();
        Session::flash('success', 'Cập nhập thành công!');
        return redirect('/admin/users/list');
    }
}
