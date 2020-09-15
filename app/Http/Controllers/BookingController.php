<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use App\BookingItem;
use App\Shop;

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
        return response()->json($Booking,200);
    }
    
    public function listshop()
    {
        $shop = Shop::with('room')->get();
        return response()->json($shop,200);
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
    public function store(Request $request)
    {
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
        $booking->save();

        $bookingItem = new bookingItem();
        $bookingItem-> booking_id = $booking->id;
        $bookingItem[] = [
            'item_id'=> $request->input("item_id"),
            'quantity'=> $request->input("quantity")
        ];
        // $bookingItem-> item_id = $request->input("item_id");
        // $bookingItem-> quantity = $request->input("quantity");
        // $bookingItem
        $bookingItem->save();
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
            return response()->json(["message"=>"Room not found"], 404);
        }
        return response()->json($booking,200);
    }

    public function shopdetail($id)
    {
        $shop = Shop::with('room')->find($id);
        return response()->json($shop,200);
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
