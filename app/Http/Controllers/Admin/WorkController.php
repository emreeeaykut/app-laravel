<?php

namespace App\Http\Controllers\Admin;

use Validator;
use File;
use App\Admin\Work;
use App\Admin\WorkImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Work::orderBy('id', 'desc')->paginate(15);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
        ];

        $messages = [
            'required' => ':attribute alanı boş bırakılamaz.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 422);
        }

        if ($request->main_img)
        {
            $image = $request->main_img;
            $image_name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            \Image::make($request->main_img)->save(storage_path('app/public/') . $image_name);
        }
        else
        {
            $image_name = '';
        }

        $newWork = Work::create([
            'main_img' => $image_name,
            'title' => $request->title,
            'detail' => $request->detail,
            'iframe1' => $request->iframe1,
            'iframe2' => $request->iframe2,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return response()->json(['data' => $newWork, 'success' => 'Proje başarılı bir şekilde eklendi.'], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Work $work)
    {
        $rules = [
            'title' => 'required',
        ];

        $messages = [
            'required' => ':attribute alanı boş bırakılamaz.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 422);
        }

        $dataWork = array(
            'title' => $request->title,
            'detail' => $request->detail,
            'iframe1' => $request->iframe1,
            'iframe2' => $request->iframe2,
            'updated_at' => date('Y-m-d H:i:s'),
        );


        if ($request->main_img)
        {
            if ($request->existing_main_img) 
            {
                File::delete(storage_path('app/public/') . $request->existing_main_img);
            }

            $image = $request->main_img;
            $image_name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            \Image::make($request->main_img)->save(storage_path('app/public/') . $image_name);
            $dataWork['main_img'] = $image_name;
        }

        $work->update($dataWork);

        return response()->json(['data' => $work, 'success' => 'Proje başarılı bir şekilde güncellendi.'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function destroy(Work $work)
    {
        $images = WorkImage::where('work_id', $work->id)->get();

        if ($images)
        {
            foreach ($images as $value) 
            {
                File::delete(storage_path('app/public/') . $value->image);
                WorkImage::where('id', $value->id)->delete();
            }   
        }

        File::delete(storage_path('app/public/') . $work->main_img);

        $work->delete();
        
        return response()->json('Proje silindi.', 200); 
    }

    public function total()
    {
        $total_record = Work::count();

        return response()->json(['data' => array('total' => $total_record)], 200);
    }
}
