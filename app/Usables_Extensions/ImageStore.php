<?php

namespace App\Usables_Extensions;

use Exception;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
trait ImageStore{
    use WriteRead;
    public function SaveImageFromWeb(Request $request,string &$filename,string &$error,array $params=[]){
        try{
            if($request->hasFile('document_1')){
                $image=$request->input('document_1');
                $base64decode=base64_decode($image);
                $uniquefilename='document_1';
                $foldername='test';
                $filename = $foldername.'/'.$uniquefilename; // Store this in database
                $img=Image::make($base64decode);
                $img->resize(500, 250);
                $img->stream();
                $error='';                
                $isstored=$this->StoreImage($filename,$img,$error);
                if(!$isstored){
                    throw new Exception("Store Exception : ".__METHOD__." image store failed ". $error);
                }
                return true;
            }
        }catch(Exception $ex){ 
            $error=$ex->getMessage();           
            return false;
        }
    }
    public function SaveImageFromMobile(Request $request,string &$filename,string &$error,array $params=[]){
        try{
            if($request->hasFile('document_1')){
                $image=$request->input('document_1');
                $base64decode=base64_decode($image);
                $uniquefilename='document_1';
                $foldername='test';
                $filename = $foldername.'/'.$uniquefilename; // Store this in database
                $img=Image::make($base64decode);
                $img->resize(500, 250);
                $img->stream();
                $error='';                
                $isstored=$this->StoreImage($filename,$img,$error);
                if(!$isstored){
                    throw new Exception("Store Exception : ".__METHOD__." image store failed ". $error);
                }
                return true;
            }
        }catch(Exception $ex){            
            $error=$ex->getMessage();
            return false;
        }
    }
}