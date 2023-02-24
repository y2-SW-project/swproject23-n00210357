<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     //some authentication
    public function __construct()
    {
        $this->middleware('auth');
    }

    //bring the home controller to the fish index page and checks if user is admin
    public function index()
    {
        $user = Auth::user();
        $home = 'home';

        if($user->hasRole('admin'))
        {
            $home = 'admin.fishs.index';
        }
        else if ($user->hasRole('user'))
        {
            $home = 'user.fishs.index';
        }
        return redirect()->route($home);
    }

    //bring the home controller to the basket index page and checks if user is admin
    public function basketIndex(Request $request)
    {
        $user = Auth::user();
        $home = 'home';

        if($user->hasRole('admin'))
        {
            $home = 'admin.baskets.index';
        }
        else if ($user->hasRole('user'))
        {
            $home = 'user.baskets.index';
        }
        return redirect()->route($home);
    }

    //bring the home controller to the fishery index page and checks if user is admin
    public function fisheryIndex(Request $request)
    {
        $user = Auth::user();
        $home = 'home';

        if($user->hasRole('admin'))
        {
            $home = 'admin.fisheries.index';
        }
        else if ($user->hasRole('user'))
        {
            $home = 'user.fisheries.index';
        }
        return redirect()->route($home);
    }
}
