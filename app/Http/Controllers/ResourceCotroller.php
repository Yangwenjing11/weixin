<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResourceCotroller extends Controller
{
    public function upload(){
        return view('resource.upload');
    }
    public  function upload_do(Request $request)
    {
        $type = $request->input('type');
//         dd($type);
        $file_obj = $request->file('upload_file');
//        dd($file_obj);
        $file_ext = $file_obj->getClientOriginalExtension();
        $file_name = time().rand(1000,9999).".".$file_ext;
        $path = $request->file('upload_file')->storeAs("upload/".$type."/",$file_name);
        $url = "https://api.weixin.qq.com/cgi-bin/media/upload?access_token=".access_token()."&type=".$type;
//        dd($url);
        $re = curl_file($url,storage_path("app/public/upload/".$type."/".$file_name));
        $res = json_decode($re,1);
        dd($res);

    }
}
