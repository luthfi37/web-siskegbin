<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ForgotPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Admin;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Session;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login() {
        return view('admin.login.index');
    }

    public function loginAdmin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->except(['_token']);

            $user = User::where('email', $request->email)->first();
            if($user){
                if(Hash::check($request->password, $user->password)) {
                    if (auth()->attempt($credentials)) {
                        if (auth()->check() && $user->where('role_id', '=', 1)) {
                            return redirect('roles');
                        } else {
                            Auth::logout();
                            notify()->warning("Hak akses hanya untuk Admin!", "Gagal", "topRight");
                            return redirect()->back();
                        }
                    } else {
                        \Auth::logout();
                        notify()->warning("Kredensial tidak valid!", "Gagal", "topRight");
                        return redirect()->back();
                    }
                } else {
                    notify()->warning("Email atau kata sandi salah!", "Gagal", "topRight");
                    return redirect()->back();
                }
            } else {
                notify()->warning("Akun tidak ditemukan!", "Gagal", "topRight");
                return redirect()->back();
            }
    }

    public function forgotPassword() {
        return view('admin.login.password.forgot');
    }

    public function forgotPasswordEmail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:100',
        ]);

            $user = DB::table('users')->where('email', $request->email)->first();

            if ($user) {
                return redirect()->route('resetPass-admin');
            } else {
                notify()->warning("Email ini tidak terdaftar pada kami!", "Gagal", "topRight");
                return redirect()->back();
            }
    }

    public function reset() {
        return view('admin.login.password.reset');
    }

    public function resetPassword(Request $request) {
        $this->validate($request, [
            'npass' => 'required|min:6|max:50',
            'cnpass' => 'required|min:6|max:50|same:npass',
        ]);

            User::where('email', $request->email)->update([
                'password' => Hash::make($request->npass),
            ]);

            notify()->success("Password berhasil diperbarui!", "success", "topRight");
            return redirect()->route('home');
    }

    public function logout(Request $request) {
            Auth::logout();
            return redirect('/');
    }
}
