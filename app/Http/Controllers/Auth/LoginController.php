<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function username()
    {
        return 'username';
    }

    protected function credentials(Request $request)
    {
        return config('app.auth_ldap') ?
            [
                'userprincipalname' => $request->username,
                'password' => $request->password,
            ] :
            [
                'email' => $request->username,
                'password' => $request->password,
            ];
    }
}
