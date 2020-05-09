<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use Illuminate\Support\Facades\Auth;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



   /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $userHoo = Socialite::driver('facebook')->user();

        //Checking if user exists and let login

       $user = User::where('email', $userHoo->user['email'])->first();

        if ($user) {
            
          if  (Auth::loginUsingId($user->id)){

            return redirect('home');
          }
        }

         //else pushing to signup
       $usersignup =  User::create([
            'name' => $userHoo->user['name'],
            'email' => $userHoo->user['email'],
            'password' => bcrypt('1234'),
        ]);

       if ($usersignup) {

         if  (Auth::loginUsingId($usersignup->id)){

            return redirect()->route('home');

          }
           
       }


    }





}
