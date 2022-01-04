<?php

namespace App\Http\Controllers\API;



use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Validator;

use App\Models\SoundSettings;
use App\Http\Resources\SoundSettingsResource;
use App\Http\Controllers\Controller;

class SoundSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SoundSettings::all();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'volume' => 'required|numeric|max:100|min:0',
            'treble' => 'required|numeric|max:100|min:0',
            'mid' => 'required|numeric|max:100|min:0',
            'bass' => 'required|numeric|max:100|min:0',
        ]);
         
        if($validator->fails()){
            return response()->json([$validator->errors()], 404);       
        }

        $soundsettings = new SoundSettings;
        $soundsettings->volume = $request->volume;
        $soundsettings->treble = $request->treble;
        $soundsettings->mid = $request->mid;
        $soundsettings->bass = $request->bass;

        $soundsettings->save();

        return response()->json(["POST succes, soundsettings inserted",$soundsettings]);
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
            return response()->json(['Data not found', 'please provide a valid id'], 404); 
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
    public function update(Request $request, $id)
    {

        $soundsettings = SoundSettings::find($id);
        if ($soundsettings !== null){
            $validator = Validator::make($request->all(),[
                'volume' => 'required|numeric|max:100|min:0',
                'treble' => 'required|numeric|max:100|min:0',
                'mid' => 'required|numeric|max:100|min:0',
                'bass' => 'required|numeric|max:100|min:0',
            ]);
             
            if($validator->fails()){
                return response()->json($validator->errors());       
            }
    
            $soundsettings = new SoundSettings;
            $soundsettings->volume = $request->volume;
            $soundsettings->treble = $request->treble;
            $soundsettings->mid = $request->mid;
            $soundsettings->bass = $request->bass;
    
            $soundsettings->save();
            
            return response()->json(['SoundSettings updated successfully.', $soundsettings]);
        } 
        else 
        {
            return response()->json(['failed','No soundsetting was found! please provide a valid Id'],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $soundsettings = SoundSettings::find($id);

        if ($soundsettings !== null)
        {

            $soundsettings->delete();
            
            return response()->json(['Soundsetting removed succesfully', $soundsettings]);
        } 
        else 
        {
            return response()->json(['failed','No soundsetting was found! please provide a valid Id'], 404);
        }
    }


}
