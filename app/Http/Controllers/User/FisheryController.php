<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\basket;
use App\Models\fishery;
use App\Models\fish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

//controlles the placement of the fisheries table/model across the laravel website
class FisheryController extends Controller
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

        $fisheries = fishery::with('user')->get();
        $fisheries = fishery::all();
        //authenticates the fisheries to their latest update in pages of 5
        //$fisheries = fishery::where('user_id', Auth::id())->latest('updated_at')->paginate(5);


        $fisheries = Fishery::paginate(6);

        //brings the user to the index page along with the linked in fisheries
        return view('user.fisheries.index')->with('fisheries', $fisheries);
    }

    /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */

      // brings the user to their show page when called
      public function show(Fishery $fishery)
     {
        $user = Auth::user();
        $user->authorizeRoles('user');

        $fisheries = fishery::with('fishin')->get();
        //checks that the fisheries are the property of the user otheir wise it calls a 403 error
        if ($fishery->user_id != Auth::id())
        {
            return abort(403);
        }
        $fishins = fishin::with('basket')->with('fishery')->get();
        //opens up the show page for the user
        return view('user.fisheries.show')->with('fishery', $fishery);
    }
}
