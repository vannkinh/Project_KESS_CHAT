<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use App\BookingItem;
use App\Shop;
use App\User;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allbooking()
    {
        // $Booking = Booking::where('user_id',1)->get();
        // $bookingItem = BookingItem::with('booking')->get(['shop_id','user_id']);
        $Booking = Booking::with(['user','bookingItem'])->get();
        return response()->json(['data'=>$Booking],200);
    }
    
    public function listshop()
    {
        $shop = Shop::with('room','table')->get();
        return response()->json(['data'=>$shop],200);
    }

    public function listalluser(){
        $user = User::with('booking')->get();
        return response()->json(['data'=>$user],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createbooking(Request $request)
    {
        // dd($request->get('items'));

        $booking = new booking();
        $booking-> type = "room";
        $booking-> shop_id = $request->input("shop_id");
        $booking-> user_id = $request->input("user_id");
        $booking-> date = $request->input("date");
        $booking-> start_date = $request->input("start_date");
        $booking-> end_date = $request->input("end_date");
        $booking-> subtotal = $request->input("subtotal");
        $booking-> total = $request->input("total");
        $booking-> paymentMethod = $request->input("paymentMethod");
        $booking-> comment = $request->input("comment");
        // $booking->save();

        $bookingItem = new bookingItem();
        $bookingItem-> booking_id = $booking->id;
        $item = $request->items;
        // dd($item);
        $ele=[];
        for ($i = 0; $i < count($item); $i++){
            // etecho "The result is"+$item[0];
            // $ele0 = $item[0];
            // $ele1 = $item[1];
            $ele[$i]['item_id'] = $item[$i]['item_id'];
            $ele[$i]['quantity'] = $item[$i]['quantity'];
            $ele[$i]['booking_id'] = $booking->id;
            
            // dd($ele0,$ele1);
            // dd(count($item));

        }
        dd($ele);

        // foreach ( $item as $items) {
        //     $bookingItem::insert([

        //     ])

        // }  
        // $bookingItem-> $request->items;
        // $bookingItem->save();
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bookingdetail($id)
    {
        $booking = Booking::with(['user','bookingItem'])->find($id);
        if(is_null($booking)){
            return response()->json(["message"=>"Not found"], 404);
        }
        return response()->json(['data'=>$booking],200);
    }


    public function shopdetail($id)
    {
        $shop = Shop::with(['room','table'])->find($id);
        if(is_null($shop)){
            return response()->json(["message"=>"Shop not found"], 404);
        }
        return response()->json(['data'=>$shop],200);
    }
    
    public function floordetail($id)
    {
        $floor = Room::find($id);
        if(is_null($floor)){
            return response()->json(["message"=>"Shop not found"], 404);
        }
        return response()->json(['data'=>$floor],200);
    }


    public function userbookinghistory($id)
    {
        $user = User::with('booking')->find($id);
        if(is_null($user)){
            return response()->json(["message"=>"This booking is null"], 404);
        }
        return response()->json(['data'=>$user]);
    }


    public function shopbookinghistory($id)
    {
        $shop = Shop::with('booking')->find($id);
        if(is_null($shop)){
            return response()->json(["message"=>"Shop not found"], 404);
        }
        return response()->json(['data'=>$shop],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
