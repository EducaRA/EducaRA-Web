<?php
     
namespace App\Http\Controllers\API;
     
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\AugumentedObject;
use Validator;
use App\Http\Resources\AugumentedObjectResource;
     
class AugumentedObjectController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $augumentedObjects = AugumentedObject::all();
      
        return $this->sendResponse(AugumentedObjectResource::collection($augumentedObjects), 'AugumentedObjects retrieved successfully.');
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
            'name' => 'required',
            'description' => 'required'
        ]);
     
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
     
        $augumentedObject = AugumentedObject::create($input);
     
        return $this->sendResponse(new AugumentedObjectResource($augumentedObject), 'AugumentedObject created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $augumentedObject = AugumentedObject::find($id);
    
        if (is_null($augumentedObject)) {
            return $this->sendError('AugumentedObject not found.');
        }
     
        return $this->sendResponse(new AugumentedObjectResource($augumentedObject), 'AugumentedObject retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AugumentedObject $augumentedObject)
    {
        $input = $request->all();
     
        $validator = Validator::make($input, [
            'name' => 'required',
            'initial' => 'required'
        ]);
     
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
     
        $augumentedObject->name = $input['name'];
        $augumentedObject->initial = $input['initial'];
        $augumentedObject->save();
     
        return $this->sendResponse(new AugumentedObjectResource($augumentedObject), 'AugumentedObject updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AugumentedObject $augumentedObject)
    {
        $augumentedObject->delete();
     
        return $this->sendResponse([], 'AugumentedObject deleted successfully.');
    }
}