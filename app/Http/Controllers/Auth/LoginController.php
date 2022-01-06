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

    // Limit Login 
    protected $maxAttempts = 3;
    protected $decayMinutes = 1;

    // Google Authentication
    public function authenticated()
    {
        if(Auth::user()->roles == 'ADMIN' ? 'SELLER' : 'CUSTOMER')
        {
            return redirect('/');
        }
    }

    // Login & Register with Google
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handlerProviderCallback(Request $request)
    {

        $callback = Socialite::driver('google')->stateless()->user();

        $data = [
            'name' => $callback->getName(),
            'email' => $callback->getEmail(),
            'password' => false,
            'email_verified_at' => date('Y-m-d H:i:s', time())
        ];

        $user = User::firstOrCreate(['email' => $data['email']], $data);
        Auth::login($user, true);

        return redirect()->route('home');


        // try {
        //     $user_google = Socialite::driver('google')->user();
        //     $user = User::where('email', $user_google->getEmail())->first();
            
        //     if ($user != null) {
        //         \auth()->login($user, true);
        //         return redirect()->route('/');
        //     } else {
        //         $create = User::create([
        //             'email' => $user_google->getEmail(),
        //             'name' => $user_google->getName(),
        //             'password' => 0,
        //             'email_verified_at' => now(),
        //         ]);

        //         \auth()->login($create, true);
        //         return redirect()->route('/');
        //     }
        // } catch (\Throwable $th) {
        //     return redirect()->route('login');
        // }
    }

    // login with facebook

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handlerFacebookCallback(Request $request)
    {
        try {
            $user_facebook = Socialite::driver('facebook')->user();
            $user = User::where('email', $user_facebook->getEmail())->first();

            if($user != null)
            {
                \auth()->login($user, true);
                return redirect()->route('/');
            }else{
                $create = User::create([
                    'email' => $user_facebook->getEmail(),
                    'name' => $user_facebook->getName(),
                    'password' => 0,
                    'email_verified_at' => now(),

                ]);
                \auth()->login($create, true);
                return redirect()->route('/');
            }
        } catch (\Exception $e) {
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
