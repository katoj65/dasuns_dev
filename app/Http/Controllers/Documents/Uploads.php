<?php

namespace App\Http\Controllers\Documents;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class uploads extends Controller
{

//file upload method
function upload_documents($request){
$file_extension = $request->file('upload')->extension();
if($file_extension=='jpg' or $file_extension=='jpeg' or $file_extension=='png'){
$file=$request->file('upload');
$file_name=$file->getClientOriginalName();
$path=$file->getRealPath();
$size=$file->getSize();
$destination='public/documents';
$file->move($destination,$file_name);
$download_path=$destination.'/'.$file_name;
$rename=rename($destination.'/'.$file_name,
$destination.'/'.md5(date('ymdimh')).'.jpg'
);
if($rename){
$download_path=$destination.'/'.md5(date('ymdimh')).'.jpg';
}else{
$download_path=$download_path;
}
if($file){
return ['status'=>true,'document'=>$download_path];
}else{
return ['status'=>false];
}
}else{
return ['status'=>false];
}
}



}
