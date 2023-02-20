<?php

namespace App\Http\Controllers\Admin;

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
         $user->authorizeRoles('admin');

         $baskets = basket::all();
         //authenticates the baskets to their latest update in pages of 5
         //$baskets = basket::where('user_id', Auth::id())->latest('updated_at')->paginate(5);


         $baskets = Basket::paginate(10);

         //brings the user to the index page along with the linked in baskets
         return view('admin.baskets.index')->with('baskets', $baskets);
     }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */

      //when called sends the user to the baskets create page
     public function create()
     {
         $user = Auth::user();
         $user->authorizeRoles('admin');

         //sends the user to the create page
         $basket = basket::all();

         return view('admin.baskets.create')->with('basket', $basket);
     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */

 //when called it stores the given data for baskets into the database basket table
 public function store(Request $request)
 {
     $user = Auth::user();
     $user->authorizeRoles('admin');

     //checks if given data is valid before sending to database
     $request->validate([
         'location' => 'required',
         'station_master' => 'required|max:120',
         //'picture' => 'required',
         'picture' => 'file|image',
         'has_dock' =>'required|integer',
         'has_airport' =>'required|integer'
     ]);

     $picture = $request->file('picture');
     $extension = $picture->getClientOriginalExtension();
     // the filnam needs to be unique, I use title and add the date to guarantee a unique filnam, ISBN would be better here.
     $filnam = date('Y-m-d-His') . '_' . $request->input('title') . '.'. $extension;
     $path = $picture->storeAs('public/images/basket', $filnam);

     //uses the new data to create a new fish in the fish table
     Basket::create([
         'uuid' => Str::uuid(),
         'user_id' => Auth::id(),
         'location' => $request->location,
         'station_master' => $request->station_master,
         'picture' => $filnam,
         'has_dock' => $request->has_dock,
         'has_airport' => $request->has_airport
     ]);

     //brings the user to the index page
     $basket = basket::all();
     return to_route('admin.baskets.index')->with('basket',$basket);
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
        $user->authorizeRoles('admin');

        if ($basket->user_id != Auth::id())
        {
            return abort(403);
        }
        //opens up the show page for the user
        return view('admin.baskets.show')->with('basket', $basket);
    }

       /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //sends the user the the edit page with their selected basket
    public function edit(Basket $basket)
    {
        if ($basket->user_id != Auth::id())
        {
            return abort(403);
        }

        return view('admin.baskets.edit')->with('basket', $basket);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\basket  $basket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Basket $basket)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        if ($basket->user_id != Auth::id())
        {
            return abort(403);
        }
      //  dd($request);
        //   //This function is quite like the store() function.
          $request->validate([
            'location' => 'required',
            'station_master' => 'required',
            //'picture' => 'required|max:500',
            'has_dock' =>'required|integer',
            'has_airport' =>'required|integer',
            //'picture' => 'file|picture|dimensions:width=300,height=400'
           'picture' => 'file|image'
        ]);

        $picture = $request->file('picture');
     $extension = $picture->getClientOriginalExtension();
     // the filnam needs to be unique, I use title and add the date to guarantee a unique filnam, ISBN would be better here.
     $filnam = date('Y-m-d-His') . '_' . $request->input('title') . '.'. $extension;
     $path = $picture->storeAs('public/images/basket', $filnam);

        $basket->update([
            'location' => $request->location,
            'station_master' => $request->station_master,
            'picture' => $filnam,
            'has_dock' => $request->has_dock,
            'has_airport' => $request->has_airport,
        ]);

        return to_route('admin.baskets.show', $basket)->with('success','Basket updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

      //when called with a basket id it allows it to be deleted and sends the user back to the users index page
     public function destroy(Basket $basket)
     {
         $user = Auth::user();
         $user->authorizeRoles('admin');

         //call error 403 if the basket id is not connected to the user preventing another user from deleting someone elses basket
         if ($basket->user_id != Auth::id())
         {
             return abort(403);
         }

         $basket->delete();

         //returns the user to index page and plays the success message Basket deleted
         return to_route('admin.baskets.index')->with('success', 'Basket deleted');
     }
}
