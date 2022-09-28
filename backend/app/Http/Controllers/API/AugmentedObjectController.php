<?php
     
namespace App\Http\Controllers\API;
     
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\AugmentedObject;
use Validator;
use App\Http\Resources\AugmentedObjectResource;
use Illuminate\Support\Facades\File;
     
class AugmentedObjectController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $augmentedObjects = AugmentedObject::all();
      
        return $this->sendResponse(AugmentedObjectResource::collection($augmentedObjects), 'AugmentedObjects retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input = $request->except('ar_file');
     
        $validator = Validator::make($input, [
            'name' => 'required',
            'description' => 'required'
        ]);
     
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
     
        $augmentedObject = AugmentedObject::create($input);
        
        $augmentedObject->filehash=hash_file('md5', $request->ar_file);
        $augmentedObject->size = $request->ar_file->getSize();
        $augmentedObject->extension = $request->ar_file->getClientOriginalExtension();
        $augmentedObject->path = $request->ar_file->storeAs('objetos/' . $augmentedObject->id, $augmentedObject->filehash.'.'. $augmentedObject->extension);
        $augmentedObject->save();

     
        return $this->sendResponse(new AugmentedObjectResource($augmentedObject), 'AugmentedObject created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $augmentedObject = AugmentedObject::find($id);
    
        if (is_null($augmentedObject)) {
            return $this->sendError('AugmentedObject not found.');
        }
     
        return $this->sendResponse(new AugmentedObjectResource($augmentedObject), 'AugmentedObject retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AugmentedObject $augmentedObject)
    {
        $input = $request->except('ar_file');
     
        $validator = Validator::make($input, [
            'name' => 'required',
            'description' => 'required'
        ]);
     
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
     
        $augmentedObject->name = $input['name'];
        $augmentedObject->description = $input['description'];

        if (isset($request->ar_file) && $request->ar_file->getSize() > 0) {
            $augmentedObject->filehash=hash_file('md5', $request->ar_file);
            $augmentedObject->size = $request->ar_file->getSize();
            $augmentedObject->extension = $request->ar_file->getClientOriginalExtension();
            $augmentedObject->path = $request->ar_file->storeAs('objetos/' . $augmentedObject->id, $augmentedObject->filehash.'.'. $augmentedObject->extension);
            
        }

        $augmentedObject->update();
     
        return $this->sendResponse(new AugmentedObjectResource($augmentedObject), 'AugmentedObject updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AugmentedObject $augmentedObject)
    {

        if (File::deleteDirectory(storage_path('app/objetos/') . $augmentedObject->id)){
            $augmentedObject->delete();
            return $this->sendResponse([], 'AugmentedObject deleted successfully.');

        } else 
            return $this->sendError('Deleted Error', 'Could not delete file', 400);
     
    }

    public function download(AugmentedObject $augmentedObject)
    {
        // Check if file exists in app/storage/file folder
        
        $file_path = storage_path('app/objetos/'.$augmentedObject->id.'/'.$augmentedObject->path);
        return response()->download($file_path);
    }
}