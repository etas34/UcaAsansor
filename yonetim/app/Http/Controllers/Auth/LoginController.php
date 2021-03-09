<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\LogModel;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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


    public function authenticate(Request $request)
    {
        $email = $request->email;
        $password=$request->password;


        if (Auth::attempt(['email' => $email, 'password' => $password,'durum' => 1])) {
            $this->authenticated($request, Auth::user());
            return Redirect(route('home'));
        }
        else
        {
            return Redirect(route('login'));
        }
    }


    function authenticated(Request $request, $user)
    {
        $user->update([
            'last_login_at' => Carbon::now()->toDateTimeString(),
            'last_login_ip' => $request->getClientIp()
        ]);

        $log=new LogModel();
        $log->user=$user->name;
        $log->islem='Login';
        $log->save();

    }
}
