<?php
     
namespace App\Http\Controllers\API;
     
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Room;
use Illuminate\Validation\Validator;
use App\Http\Resources\RoomResource;
     
class RoomController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::all();
      
        return $this->sendResponse(RoomResource::collection($rooms), 'Rooms retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
     
        $validator = Validator::make($input, [
            'code' => 'required',
            'owner' => 'required'
        ]);
     
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
     
        $room = Room::create($input);
     
        return $this->sendResponse(new RoomResource($room), 'Room created successfully.');
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
    
        if (is_null($room)) {
            return $this->sendError('Room not found.');
        }
     
        return $this->sendResponse(new RoomResource($room), 'Room retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        $input = $request->all();
     
        $validator = Validator::make($input, [
            'code' => 'required',
            'owner' => 'required'
        ]);
     
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
     
        $room->code = $input['code'];
        $room->owner = $input['owner'];
        $room->name = $input['name'];
        $room->save();
     
        return $this->sendResponse(new RoomResource($room), 'Room updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        $room->delete();
     
        return $this->sendResponse([], 'Room deleted successfully.');
    }
}