<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\Shop;
use App\Image;
use App\Table;
use Validator;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allrooms()
    {
        // $room = Room::where('id',1)->get();
        // $room = Room::get();
        $room = Room::with(['shop','image'])->get();
        // $room = Room::get(['name','max_people']);
        // $room = Room::with('shop')->get('name');
        return response()->json(['data'=>$room],200);
    }

    public function alltable()
    {
        $table = Table::with(['shop','image'])->get();
        return response()->json(['data'=>$table],200);

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
    public function createroom(Request $request)
    {
            $room = new room();
            $room -> name = $request->input("name");
            $room -> max_people = $request->input("max_people");
            $room -> floor = $request->input("floor");
            $room -> price = $request->input("price");
            $room -> special_price = $request->input("special_price");
            $room -> shop_id = $request->input("shop_id");
            $room -> deposit = $request->input("deposit");
            $room-> status = "true";
            $room -> description = $request->input("description");
            $room->save();


           $image = new image();
            $image-> item_id = $room->id;
            $image-> type = "room";
            if ($request->hasfile('image')){
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' .$extension;
                $file_url = 'images/'.$filename;
                $file->move('images/', $filename);
                $image->image = $file_url;
            }
            else {
                return $request;
                $image->image = '';
            }
            $image->save();
            
    }

    public function createtable(Request $request)
    {
            $table = new table();
            $table -> name = $request->input("name");
            $table -> max_people = $request->input("max_people");
            $table -> floor = $request->input("floor");
            $table -> price = $request->input("price");
            $table -> special_price = $request->input("special_price");
            $table -> shop_id = $request->input("shop_id");
            $table -> deposit = $request->input("deposit");
            $table-> status = "true";
            $table -> description = $request->input("description");
            $table->save();


            $image = new image();
            $image-> item_id = $table->id;
            $image-> type = "table";
            if ($request->hasfile('image')){
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' .$extension;
                $file_url = 'images/'.$filename;
                $file->move('images/', $filename);
                $image->image = $file_url;
            }
            else {
                return $request;
                $image->image = '';
            }
            $image->save();
            
        }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function roomdetail($id)
    {
        // $room = Room::where('id',1)->get();

        // $room = Room::find($id);
        $room = Room::with(['shop','image'])->find($id);
        if(is_null($room)){
            return response()->json(["message"=>"Room not found"], 404);
        }
        return response()->json(['data'=>$room],200);
    }


    public function tabledetail($id)
    {
        $table = Table::with(['shop','image'])->find($id);
        if(is_null($table)){
            return response()->json(["message"=>"Table not found"], 404);
        }
        return response()->json(['data'=>$table],200);
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
    public function updateroom(Request $request, $id)
    {
        $room = Room::find($id);
        if(is_null($room)){
            return response()->json(["message" => "Room not found!"], 404);
        }
        $room ->update($request->all());
        return response()->json(['data'=>$room],200);
    }

    public function updatetable(Request $request, $id)
    {
        $table = Table::find($id);
        if(is_null($table)){
            return response()->json(["message" => "Table not found!"], 404);
        }
        $table ->update($request->all());
        return response()->json(['data'=>$table],200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyroom($id)
    {
        $room = Room::find($id);
        if(is_null($room)){
            return response()->json(["message" => "Room not found!"], 404);
        }
        $room->delete();
        return response()->json(null,204);
    }
    public function destroytable($id)
    {
        $table = Table::find($id);
        if(is_null($table)){
            return response()->json(["message" => "Table not found!"], 404);
        }
        $table->delete();
        return response()->json(null,204);
    }
}
