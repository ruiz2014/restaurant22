<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;             //ESTO ES PARA LA AUTENTIFICACION
use Illuminate\Validation\ValidationException;   //ESTO PARA EL TROW VALIDATIONERROR
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Redirector;

use App\Http\Requests\LoginRequest;
use App\Models\User;

class LoginController extends Controller
{
    public function login(LoginRequest $req){
        $email = $req->email;
        $pass = $req->password;

        $user =  User::where('email', $email)->first();

        if($user){
            if(Hash::check($pass, $user->password2)){
                Auth::login($user);
                $req->session()->regenerate();
                return redirect('admin')->with('status', 'You are loggead');
            }
        }
        
        if(Auth::attempt(['email' => $email, 'password' => $pass])){
            $req->session()->regenerate();
            return redirect('admin')->intended()->with('status', 'You are loggead');

            // redirect()->intended()->with()
        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed')
        ]);
        
        return redirect('login');
    }

    public function logout(Request $req, Redirector $redirect){
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return $redirect->to('/');
    }
}
