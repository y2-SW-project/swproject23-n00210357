<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\destination;
use App\Models\catcher;
use App\Models\fish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

//controlles the placement of the catchers table/model across the laravel website
class CatcherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     // The part of the controller that sends the user and their select data to the index page
    public function index()
    {
        $user = Auth::user();
        $user->authorizeRoles('user');

        $catchers = catcher::with('user')->get();
        $catchers = catcher::all();
        //authenticates the catchers to their latest update in pages of 5
        //$catchers = catcher::where('user_id', Auth::id())->latest('updated_at')->paginate(5);


        $catchers = Catcher::paginate(10);

        //brings the user to the index page along with the linked in catchers
        return view('user.catchers.index')->with('catchers', $catchers);
    }

    /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */

      // brings the user to their show page when called
      public function show(Catcher $catcher)
     {
        $user = Auth::user();
        $user->authorizeRoles('user');

        $catchers = catcher::with('fish')->get();
        //checks that the catchers are the property of the user otheir wise it calls a 403 error
        if ($catcher->user_id != Auth::id())
        {
            return abort(403);
        }
        $trains = fish::with('destination')->with('catcher')->get();
        //opens up the show page for the user
        return view('user.catchers.show')->with('catcher', $catcher);
    }
}
