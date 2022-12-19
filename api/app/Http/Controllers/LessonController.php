<?php

namespace App\Http\Controllers;

use App\Http\Resources\LessonResource;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return LessonResource::collection(Lesson::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only('title', 'image', 'cours_id', 'video');
        $validator = Validator::make($data, [
            'image'        => 'required',
            'video'        => 'required',
            'title'        => 'required|string',
            'cours_id'    => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $title = str_replace(' ', '_', $request->title);
        $filename = $title.'.'.$request->image->extension();
        $image_path = $request->image->storeAs(
            "lessons/".$title,
            $filename,
            'public'
        );

        $filename_video = $title.'.'.$request->video->extension();
        $video_path = $request->video->storeAs(
            "lessons/".$title,
            $filename_video,
            'public'
        );

        Lesson::create([
            'image_path'   => $image_path,
            'title'        => $request->title,
            'cours_id'    => $request->cours_id,
            'video_path' => $video_path,
        ]);
        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function show(Lesson $lesson)
    {
        return new LessonResource($lesson);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lesson $lesson)
    {
        $data = $request->only('title', 'image', 'cours_id', 'video');
        $validator = Validator::make($data, [
            'title'        => 'required|string',
            'cours_id'    => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $title = str_replace(' ', '_', $request->title);
        if ($request->image !== null) {
            $filename = $title.'.'.$request->image->extension();
            $image_path = $request->image->storeAs(
                "lessons/".$title,
                $filename,
                'public'
            );
            $lesson->fill(['image' => $image_path]);
        }

        if ($request->video !== null) {
            $filename_video = $title.'.'.$request->video->extension();
            $video_path = $request->video->storeAs(
                "lessons/".$title,
                $filename_video,
                'public'
            );
            $lesson->fill(['video' => $video_path]);
        }

        $lesson->fill([
            'title'        => $request->title,
            'cours_id'    => $request->cours_id,
        ]);
        $lesson->save();
        return response()->json([
            'success' => true
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        return response()->json([
            'success' => true
        ]);
    }
}
