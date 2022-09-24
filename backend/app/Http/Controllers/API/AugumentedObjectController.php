<?php
     
namespace App\Http\Controllers\API;
     
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\AugumentedObject;
use Validator;
use App\Http\Resources\AugumentedObjectResource;
use Illuminate\Support\Facades\File;
     
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
        $input = $request->except('ar_file');
     
        $validator = Validator::make($input, [
            'name' => 'required',
            'description' => 'required'
        ]);
     
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
     
        $augumentedObject = AugumentedObject::create($input);
        
        $augumentedObject->filehash=hash_file('md5', $request->ar_file);
        $augumentedObject->size = $request->ar_file->getSize();
        $augumentedObject->extension = $request->ar_file->getClientOriginalExtension();
        $augumentedObject->path = $request->ar_file->storeAs('objetos/' . $augumentedObject->id, $augumentedObject->filehash.'.'. $augumentedObject->extension);
        $augumentedObject->save();

     
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
        $input = $request->except('ar_file');
     
        $validator = Validator::make($input, [
            'name' => 'required',
            'description' => 'required'
        ]);
     
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
     
        $augumentedObject->name = $input['name'];
        $augumentedObject->description = $input['description'];

        if (isset($request->ar_file) && $request->ar_file->getSize() > 0) {
            $augumentedObject->filehash=hash_file('md5', $request->ar_file);
            $augumentedObject->size = $request->ar_file->getSize();
            $augumentedObject->extension = $request->ar_file->getClientOriginalExtension();
            $augumentedObject->path = $request->ar_file->storeAs('objetos/' . $augumentedObject->id, $augumentedObject->filehash.'.'. $augumentedObject->extension);
            
        }

        $augumentedObject->update();
     
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

        if (File::deleteDirectory(storage_path('app/files/objeto/') . $augumentedObject->id)){
            $augumentedObject->delete();
            return $this->sendResponse([], 'AugumentedObject deleted successfully.');

        } else 
            return $this->sendError('Deleted Error', 'Could not delete file', 400);
     
    }

    public function download(AugumentedObject $augumentedObject)
    {
        // Check if file exists in app/storage/file folder

        $file_path = storage_path('app/files/') . $augumentedObject->url_download;
        return response()->download($file_path);
    }
}