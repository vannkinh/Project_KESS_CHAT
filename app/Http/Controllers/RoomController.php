<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use Validator;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $roomparams = [


        // ];
        $room = Room::with('shop')->get();
        return response()->json($room,200);
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
       $rules = [ 
           'name' => 'required|min:1',
           'max_people' => 'required|numeric',
           'floor' => 'required|min:1',
           'price' => 'required|numeric',
           'special_price' => 'required|numeric',
           'shop_id' => 'required|min:1',
           'deposit' => 'required|',
           'description' => 'required|min:5|max:200',
       ];
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
        $validator = Validator::make($roomparams, $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
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
        $room = Room::find($id);
        if(is_null($room)){
            return response()->json(["message"=>"Room not found"], 404);
        }
        return response()->json($room,200);
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
            return response()->json(["message" => "Room not found!"], 404);
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
            return response()->json(["message" => "Room not found!"], 404);
        }
        $room->delete();
        return response()->json(null,204);
    }
}
