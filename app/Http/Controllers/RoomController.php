<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Room::get(),200);
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
       
        $roomparams = [
            'name' => $request->get('name'),
            'max_people' => $request->get('max_people'),
            'floor' => $request->get('floor'),
            'price' => $request->get('price'),
            'special_price' => $request->get('special_price'),
            'shop_id' => $request->get('shop_id'),
            'deposit' => $request->get('deposit'),
            'description' => $request->get('description'),
            'status' => 'true'
            

        ];
        $room = Room::insert($roomparams);
        return response()->json($room,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Room::find($id),200);
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
        $room = Room::find($id);
        if(is_null($room)){
            return response()->json('not found!!', 404);
        }
        $room ->update($request->all());
        return response()->json($room,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $room = Room::find($id);
        if(is_null($room)){
            return response()->json(["message" => "Article not found!"], 404);
        }
        $room->delete();
        return response()->json(null,204);
    }
}
