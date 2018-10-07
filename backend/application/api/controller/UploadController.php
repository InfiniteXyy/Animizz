<?php
/**
 * Created by PhpStorm.
 * User: xyy
 * Date: 2018/6/19
 * Time: 下午2:30
 */

namespace app\api\controller;

use think\facade\Request;

class UploadController
{
    public function image() {
        $file = Request::file('file');
        if (is_null($file))
            e(1, 'file cannot be empty');
        if(!$file->checkSize(3*1024*1024))
            e(2, 'file size too big');
        if(!$file->checkImg())
            e(3, 'img format only');
        $info = $file->move(env('root_path') . 'public' . DIRECTORY_SEPARATOR . 'res' . DIRECTORY_SEPARATOR . 'image');
        if(!$info){
            e(4, $info->getError());
        }
        s('success', ['path' => config('animizz.upload_image_path') . $info->getSaveName()]);
    }
}