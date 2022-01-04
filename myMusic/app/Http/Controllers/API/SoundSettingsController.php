<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SoundSettings;
use App\Http\Resources\SoundSettingsResource;

class SoundSettingsController extends Controller
{
    //use Illuminate\Http\Request;

    //

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function soundsettingZoekerService()
    {
        return SoundSettings::all();
    }



        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = SoundSettings::latest()->get();
        return response()->json([SoundSettingsResource::collection($data), 'SoundSettings fetched.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
        $validator = Validator::make($request->all(),[
            'volume' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $SoundSettings = SoundSettings::create([
            'volume' => $request->volume,
            'treble' => $request->treble,
            'mid' => $request->mid,
            'bass' => $request->bass
         ]);
        
        return response()->json(['SoundSettings created successfully.', new SoundSettingsResource($SoundSettings)]);
         */
         /*
        $SoundSettings = SoundSettings::create([
            'volume' => $request->volume,
            'treble' => $request->treble,
            'mid' => $request->mid,
            'bass' => $request->bass
         ]);*/
         
        /*
         $SoundSettings = SoundSettings::create([
            'volume' => '100',
            'treble' => '90',
            'mid' => '80',
            'bass' => '70'
         ]);
         

          return new SoundSettingsResource($SoundSettings) ;
*/
        $SoundSettings = new SoundSettings;
        $SoundSettings->volume=$request->volume;
        $SoundSettings->treble=$request->treble;
        $SoundSettings->mid=$request->mid;
        $SoundSettings->bass=$request->bass;
        $result=$SoundSettings->save();
         if($result){
            return["Result"=>"Data has been saved"];
         }
         else{
            return["Result"=>"Operation failed"];
         }
            
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $SoundSettings = SoundSettings::find($id);
        if (is_null($SoundSettings)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json([new SoundSettingsResource($SoundSettings)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SoundSettings $SoundSettings)
    {
        $validator = Validator::make($request->all(),[
            'volume' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $SoundSettings->volume = $request->volume;
        $SoundSettings->treble = $request->treble;
        $SoundSettings->mid = $request->mid;
        $SoundSettings->bass = $request->bass;
        $SoundSettings->save();
        
        return response()->json(['SoundSettings updated successfully.', new SoundSettingsResource($SoundSettings)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SoundSettings $SoundSettings)
    {
        $SoundSettings->delete();

        return response()->json('SoundSettings deleted successfully');
    }


}
