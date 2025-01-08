<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\UpdateUser;

class LoginController extends Controller
{
    use AuthenticatesUsers;


    protected function authenticated(Request $request, UpdateUser $user)
    {
        return redirect()->route('dashboard');
    }

}
