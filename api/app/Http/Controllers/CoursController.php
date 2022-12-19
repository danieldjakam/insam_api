<?php

namespace App\Http\Controllers;

use App\Http\Resources\CoursResource;
use App\Models\Cours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CoursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CoursResource::collection(Cours::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only('title', 'image', 'levels_id', 'specialities_id');
        $validator = Validator::make($data, [
            'image'        => 'required',
            'specialities_id' => 'required|string',
            'title'        => 'required|string',
            'levels_id'    => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $filename = str_replace(' ', '_', $request->title).'.'.$request->image->extension();
        $image_path = $request->image->storeAs(
            "cours/banners",
            $filename,
            'public'
        );

        Cours::create([
            'image_path'   => $image_path,
            'title'        => $request->title,
            'levels_id'    => $request->levels_id,
            'specialities_id' => $request->specialities_id,
        ]);
        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cours  $cours
     * @return \Illuminate\Http\Response
     */
    public function show(Cours $cours)
    {
        return new CoursResource($cours);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cours  $cours
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cours $cours)
    {
        $data = $request->only('title', 'image', 'levels_id', 'specialities_id');
        $validator = Validator::make($data, [
            'specialities_id' => 'required|string',
            'title'        => 'required|string',
            'levels_id'    => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        if ($request->image !== null) {
            $filename = str_replace(' ', '_', $request->title).'.'.$request->image->extension();
            $image_path = $request->image->storeAs(
                "cours/banners",
                $filename,
                'public'
            );
            $cours->fill(['image_path' => $image_path]);
        }

        $cours->fill([
            'title'           => $request->title,
            'levels_id'       => $request->levels_id,
            'specialities_id' => $request->specialities_id,
        ]);
        $cours->save();
        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cours  $cours
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cours $cours)
    {
        $cours->delete();
        
        return response()->json([
            'success' => true
        ]);
    }
}
