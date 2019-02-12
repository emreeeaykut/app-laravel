<?php

namespace App\Http\Controllers\Admin;

use Validator;
use File;
use App\Admin\WorkImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WorkImageController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\WorkImage $workImage
     * @return \Illuminate\Http\Response
     */
    public function show($work_id)
    {
        return WorkImage::where('work_id', $work_id)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        if($request->get('image'))
        {
            $image = $request->get('image');
            $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            \Image::make($request->get('image'))->save(storage_path('app/public/') . $name);

             $newImage = WorkImage::create([
                'image' => $name,
                'work_id' => $request->work_id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            return response()->json(['data' => $newImage, 'success' => 'Fotoğraf başarılı bir şekilde yüklendi.'], 200);
        }
        else
        {
            return response()->json(['error' => 'Fotoğraf yüklenemedi.'], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WorkImage  $workImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkImage $workImage)
    {
        File::delete(storage_path('app/public/') . $workImage->image);
        
        $workImage->delete();

        return response()->json('Fotoğraf silindi.', 200);
    }
}
