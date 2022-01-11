<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Image;
use DB;
use SebastianBergmann\LinesOfCode\Counter;

class MyController extends Controller
{
    /**
     * Create a new controller instance.
*
*
     * @return void
     */
    public function ajaxRequest()
    {
        return view('ajaxRequest');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function ajaxRequestPost(Request $request)
    {
        $input = $request->email;
        $response = Http::post('https://super-resolution-u3v4lxreva-uk.a.run.app/upscale_image', [
            'scale' => $input->scale,
            'role' => 'Network Administrator',
        ]);
        return response()->json(['success'=> $response->body()]);
        // if ($input->email == "test@gmail.com"){
        //     return response()->json(['success'=>'Got Simple Ajax Request.']);
        // }
        // else return response()->json(['fail'=>'OK']);
    }

    public function imageUploadPost(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $imageName = time().'.'.$request->image->extension();

        $request->image->move(public_path('asset.uploads'), $imageName);

        /* Store $imageName name in DATABASE from HERE */

        return back()
            ->with('success','You have successfully upload image.')
            ->with('image',$imageName);
    }

    public function index()
    {
        return view('file');
    }

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
            $exist_image = Image::find($hash);
            // if (!$exist_image){
                // $request->file('file')->storeAs('uploads', $file_name);
                $request->file('file')->move(public_path('/uploads'), $file_name);
                // $document = new Image();
                // $document->id = $hash;
                // $document->file_name = $custom_file_name;
                // $document->save();
            // }

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

    public function admin()
    {
        $data['userList'] = DB::table('users')->join('images','users.id','images.id')
            ->select('users.id','email',DB::raw('COUNT(images.id)AS image_count'))
            ->groupByRaw('users.id,email')->get();
            $data['order'] = 0;
        return view('admin',$data);
    }
    public function destroy($id)
    {
        $data = DB::table('users')->where('id',$id)->delete();
        $data['userList'] = DB::table('users')->join('images','users.id','images.id')
            ->select('users.id','email',DB::raw('COUNT(images.id)AS image_count'))
            ->groupByRaw('users.id,email')->get();
            $data['order'] = 0;
        return view('admin',$data);
    }

}
