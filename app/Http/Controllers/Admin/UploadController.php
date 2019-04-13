<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image, Response;

class UploadController extends Controller
{
    public function uploadImgFile(Request $request)
    {
        //$file = $request->file('file');
        $file = $_FILES['file'];
        $fileType=pathinfo($file['name'],PATHINFO_EXTENSION);
    	$ext=strtolower($fileType);
        $allowed_extensions = array("jpg", "bmp", "gif", "tif","png","jpeg");
        if ($ext && !in_array($ext, $allowed_extensions)) {
            return Response::json([ 'errors' => '只能上传png、jpg、gif、等等文件.']);
        }
        $destinationPath = env('UPLOAD_FILE_PATH',config('answer.image_path'));
        $fileName = str_random(16).'.'.$fileType;
        //$file->move($destinationPath, $fileName);
        move_uploaded_file($file["tmp_name"],public_path($destinationPath.$fileName));
        $img = Image::make(public_path($destinationPath.$fileName))
                    ->resize(640, null, function ($constraint) {
                                        $constraint->aspectRatio();
                                    });
        $img->save(public_path($destinationPath.$fileName));
        $upload_prefix = env('UPLOAD_PREFIX', config('answer.pre_url'));
        $imageSrc=$upload_prefix.$fileName;
        return Response::json(
            [
                'success' => true,
                'imageSrc' => $imageSrc
            ]
        );
    }
    public function uploadVideoFile(Request $request)
    {
        $file = $request->file('videoFile');
        $fileType=strtolower($file->getClientOriginalExtension());
        if($fileType != "mp4"){
            return response()->json([ 'errors' => '只能上传mp4文件.']);
        }
        $destinationPath = env('UPLOAD_FILE_PATH',config('answer.image_path'));
        $fileName = str_random(16).'.'.$fileType;
        $file->move($destinationPath, $fileName);
        //move_uploaded_file($file["tmp_name"],public_path($destinationPath.$fileName
        $upload_prefix = env('UPLOAD_PREFIX', config('answer.pre_url'));
        $videoSrc=$upload_prefix.$fileName;
        return Response::json(
            [
                'success' => true,
                'videoSrc' => $videoSrc
            ]
        );
    }
}
