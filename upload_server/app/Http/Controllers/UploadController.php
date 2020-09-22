<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }

    public function uploadfile(Request $request)
    {
        // return ($request->name);
        $fileName = time().'.'.$request->zip_file->extension();  
   
        $request->zip_file->move(public_path('uploads'), $fileName);
        $target_url = 'http://localhost:8001/api/extract_zip'; // Write your URL here
        $dir = public_path('uploads').'/'.$fileName; // full directory of the file

        $cFile = curl_file_create($dir);
        $post = array('file'=> $cFile); // Parameter to be sent

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $target_url);
        curl_setopt($ch, CURLOPT_POST,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result=json_decode(curl_exec($ch));
        curl_close ($ch);
        // return back()
        //     ->with('success','You have successfully upload file.')
        //     ->with('file',$fileName);
        return ("success");
   
    }
}
