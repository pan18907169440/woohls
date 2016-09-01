<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect, Input, Response;
use App\Entity\MessageAnnex;



class UploadController extends Controller
{

    //Ajax上传图片
    public function imgUpload(Request $request)
    {
    $file = base64_decode($request->input("base64_string"));         //获取上传文件的信息
            //base64.b64encode($request->input("base64_string"));
    $extend = $request->input("extend");                               //获取上传文件的后缀名
    $destinationPath = 'uploads/images/';                              //  上传文件的存储路径
    $fileName = str_random(10).$extend;
    file_put_contents($destinationPath.$fileName, $file);                //移动文件到上传路径
        return Response::json(
            [
                '0' => asset($destinationPath.$fileName),
            ]
        );
    }


    public function file_index(Request $request)
    {
        return view('admin.upload.file_index');
    }

    //Ajax上传图片
    public function get_fiel(Request $request)
    {
        $file = $request->file('file');         //获取上传文件的信息

        //dd($file->getClientOriginalName());

        $id = $request->input('id');
        $allowed_extensions = ["pdf", "word", "xls", "ppt", "zip", "rar", "docx"];
        if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
            return ['error' => 'You may only upload png, jpg or gif.'];
        }

        $destinationPath = 'uploads/file/';                  //  上传文件的存储路径

        $extension = $file->getClientOriginalExtension();       //上传文件的后缀名
        $fileName = str_random(10).'.'.$extension;
        $file->move($destinationPath, $fileName);               //移动文件到上传路径

        //插入上传文件到数据库
        $annex = new MessageAnnex;
        $annex->user_id = $request->session()->get('user')->id;
        $annex->file_name = $file->getClientOriginalName();
        $annex->file_url = asset($destinationPath.$fileName);
        $annex->file_size = $this->format_bytes($file->getClientSize());
        $annex->save();

        $arr = [
            'status' => 1,
            'url'   => asset($destinationPath.$fileName),
            'id'    => $file->getClientOriginalName(),
            'info' => "成功",
        ];

        return $arr;
    }

    /**
     * @param $size
     * @return string
     * 文件大小换算
     */
    public function format_bytes($size) {
        $units = array(' B', ' KB', ' MB', ' GB', ' TB');
        for ($i = 0; $size >= 1024 && $i < 4; $i++) $size /= 1024;
        return round($size, 2).$units[$i];
    }

}