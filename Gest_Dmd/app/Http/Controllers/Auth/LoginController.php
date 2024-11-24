<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    // protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginForm()
    {
        return view('content.authentications.auth-login-basic');
    }


    protected function authenticated(Request $request, $user)
    {
        if ($user->Profil === 'ChefProjet') {
            return redirect()->route('demande-list');
        } else {
           
            echo "vous n'etes pas le droit d'acceder";
        }
    }

    protected function credentials(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
    
            if ($user && $user->Profil === 'ChefProjet') {
                session(['id_metier' => $user->metiers_id, 'id_entite' => $user->entites_id, 'id_User' => $user->id]);
                return redirect()->route('demandes-Acceuil');
            } else {
                echo "Vous n'avez pas le droit";
            }
        } else {
            echo "Erreur d'authentification";
            return false;
        }
    }
    

    
}
