<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class UserController extends Controller
{
//    protected function dbRegister()
//    {
//        return [
//            1 => ['login' => '1', 'email' => '1@tut.by', 'password' => '1']
//        ];
//        $rezult = User::all()->toArray();
//        $rezult = User::select('id', 'name', 'password')->get()->toArray();
//        return $rezult;
//    }

    public function showLogin(Request $request)
    {
        $notice = '';
        if ($request->session()->has('notice')) {
            $notice = $request->session()->get('notice');
        }

        return view('/login', ['notice' => $notice]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function showRegister()
    {

        return view('register');
    }

    public function postRegister(Request $request)
    {
        $password = $request->input('password');

        $request->validate([
            'login' => 'required',
            'email' => 'required',
            'password' => 'required',
            'confirm_password' => 'required',
        ]);

        $user = new User([
            'name' => $request->input('login'),
            'email' => $request->input('email'),
            'password' => Hash::make($password),
        ]);

        if ($user->save()) {
            $request->session()->flash('notice', 'You have successfully registered!');
            return redirect('/login');
        } else {
            return view('register', ['request' => $request]);
        }

    }

    public function showForgot()
    {
        return view('forgot');
    }

    public function postForgot(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );
//        dd($status);
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function GetPasswordReset($token){
//        dd(1);
        return view('authforgot', ['token' => $token]);
    }
    public function passwordReset($token){
        return view('authforgot', ['token' => $token]);
    }
    public function getForgotUpdate(Request $request){
        return view('authforgot', ['request' => $request]);
    }
    public function postForgotUpdate(Request $request){
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->with(['status', __($status), 'notice' => 'You success registered'])
            : back()->withErrors(['email' => [__($status)]]);
    }
}
