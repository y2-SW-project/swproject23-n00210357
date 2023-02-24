<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\basket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class BasketController extends Controller
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

         $baskets = basket::all();
         //authenticates the baskets to their latest update in pages of 5
         //$baskets = basket::where('user_id', Auth::id())->latest('updated_at')->paginate(5);


         $baskets = Basket::paginate(10);

         //brings the user to the index page along with the linked in baskets
         return view('user.baskets.index')->with('baskets', $baskets);
     }

     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */

      // brings the user to their show page when called
      public function show(Basket $basket)
     {
        $user = Auth::user();
        $user->authorizeRoles('user');

        if ($basket->user_id != Auth::id())
        {
            return abort(403);
        }
        //opens up the show page for the user
        return view('user.baskets.show')->with('basket', $basket);
    }
}
