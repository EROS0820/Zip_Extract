<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Madzipper;
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

    public function extract_zip(Request $request)
    {
        $fileName = time().'.'.$request->file->extension();  
   
        $request->file->move(public_path('uploads'), $fileName);
        $Path = public_path('uploads').'\\'.$fileName;
        \Madzipper::make($Path)->extractTo(public_path('uploads'));
        return ("success");
   
    }
}
