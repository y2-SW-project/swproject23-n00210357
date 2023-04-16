<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\basket;
use App\Models\fish;
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
         $user->authorizeRoles('admin');

         $baskets = basket::all();
         //authenticates the baskets to their latest update in pages of 5
         //$baskets = basket::where('user_id', Auth::id())->latest('updated_at')->paginate(5);


         $baskets = Basket::all();
         $fishs = Fish::paginate(6);
         //brings the user to the index page along with the linked in baskets
         return view('admin.baskets.index')->with('baskets', $baskets)->with('user', $user)->with('fishs', $fishs);
     }
}
