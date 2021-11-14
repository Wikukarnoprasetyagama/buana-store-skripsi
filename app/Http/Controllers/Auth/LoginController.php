<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/';

    public function authenticated()
    {
        if(Auth::user()->roles == 'ADMIN')
        {
            return redirect('/admin');
        } elseif (Auth::user()->roles == 'SELLER') {
            return redirect('/seller');
        }else {
            return redirect('/user');
        }

    }

    // Login & Register with Google
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handlerProviderCallback(Request $request)
    {
        try {
            $user_google = Socialite::driver('google')->user();
            $user = User::where('email', $user_google->getEmail())->first();
            
            if ($user != null) {
                \auth()->login($user, true);
                return redirect()->route('/');
            } else {
                $create = User::create([
                    'email' => $user_google->getEmail(),
                    'name' => $user_google->getName(),
                    'password' => 0,
                    'email_verified_at' => now(),
                ]);

                \auth()->login($create, true);
                return redirect()->route('/');
            }
        } catch (\Throwable $th) {
            return redirect()->route('login');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
