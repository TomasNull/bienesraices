<?php
namespace App\Helpers;

class Helper {
    public static function uploadFile($key, $path) {
        request()->file($key)->store($path);
        //dd(request()->file($key)->getClientOriginalName());
        
        return request()->file($key)->hashName();
    }

    public static function uploadPic($key, $path) {
        request()->file($key)->store($path);
        //dd(request()->file($key)->hashName());
        return request()->file($key)->hashName();
    }
}