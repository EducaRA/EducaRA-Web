<?php
     
namespace App\Http\Controllers\API;
     
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Discipline;
use Validator;
use App\Http\Resources\DisciplineResource;
     
class DisciplineController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disciplines = Discipline::all();
      
        return $this->sendResponse(DisciplineResource::collection($disciplines), 'Disciplines retrieved successfully.');
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
            'initial' => 'required'
        ]);
     
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
     
        $discipline = Discipline::create($input);
     
        return $this->sendResponse(new DisciplineResource($discipline), 'Discipline created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $discipline = Discipline::find($id);
    
        if (is_null($discipline)) {
            return $this->sendError('Discipline not found.');
        }
     
        return $this->sendResponse(new DisciplineResource($discipline), 'Discipline retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discipline $discipline)
    {
        $input = $request->all();
     
        $validator = Validator::make($input, [
            'name' => 'required',
            'initial' => 'required'
        ]);
     
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
     
        $discipline->name = $input['name'];
        $discipline->initial = $input['initial'];
        $discipline->save();
     
        return $this->sendResponse(new DisciplineResource($discipline), 'Discipline updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discipline $discipline)
    {
        $discipline->delete();
     
        return $this->sendResponse([], 'Discipline deleted successfully.');
    }
}