<?php

namespace App\Http\Controllers;

use App\OnemModel;
use App\User;
use Auth;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return Redirect(route('login'));
        }
        else
        {

            return Redirect(route('home'));
        }

    }


}
