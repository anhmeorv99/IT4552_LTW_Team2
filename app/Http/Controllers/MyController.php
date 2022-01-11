<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Image;
use App\Models\User;
use DB;

class MyController extends Controller
{

    public function store(Request $request)
    {
       request()->validate([
         'file'  => 'required|mimes:png,PNG,jpg,jpeg|max:2048',
       ]);

        if ($files = $request->file('file')) {

            $hash = md5_file($files->path());
            // store file into document folder
            $custom_file_name = $request->file('file')->getClientOriginalName();
            $extension = $request->file('file')->getClientOriginalExtension();
            $file_name = $hash . '.' . $extension;

            // // store your file into database
            if (Auth::user()){
                $exist_image = Image::find(Auth::user()->email."_".$hash);
                if (!$exist_image){
                    $request->file('file')->storeAs('uploads', $file_name);
                    $request->file('file')->move(public_path('/uploads'), $file_name);
                    $document = new Image();
                    $document->id = Auth::user()->email."_".$hash;
                    $document->file_name = $custom_file_name;
                    $document->hashed_filename = $file_name;
                    if ($request->scale == 2){
                        $document->scale_x2 = 1;
                    }
                    if ($request->scale == 4){
                        $document->scale_x4 = 1;
                    }

                    if ($request->user_id != null){
                        $document->user_id = $request->user_id;
                    }

                    $document->save();
                }else{
                    if ($request->scale == 2){
                        $exist_image->scale_x2 = 1;
                    }
                    if ($request->scale == 4){
                        $exist_image->scale_x4 = 1;
                    }
                    $exist_image->save();
                }
            }


            $response = Http::post('http://127.0.0.1:5000/upscale_image', [
                'file_name' => $file_name,
                'scale' => $request->scale
            ]);
            return response()->json([
                'image_origin' => "/uploads/".$file_name,
                "custom_file_name" => $custom_file_name,
                'result' => json_decode($response->body())
            ]);
            // return $response->body();
        }

        return Response()->json([
                "success" => false,
                "file" => ''
          ]);
    }

    public function scaled(){
        $images = null;
        if (Auth::user()){
            $user_id = Auth::user()->id;
            $images = Image::where('user_id', (int)$user_id)->paginate(1);;
        }
        return view('upscaled_images', compact('images'));
    }

    public function admin()
    {
        $data = DB::table('users')->join('images','users.id','images.user_id')
            ->select('users.id','email', 'name', 'is_admin',DB::raw('COUNT(images.id) AS image_count'))
            ->groupByRaw('users.id, email, name, is_admin')->get();
        return view('admin',  compact('data'));
    }
    public function destroy($id)
    {

        $res = Image::where('user_id',$id)->delete();

        $data = DB::table('users')->where('id',$id)->delete();

        return redirect()->route('admin');
    }


}
