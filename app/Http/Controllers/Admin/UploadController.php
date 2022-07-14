<?php

namespace App\Http\Controllers\Admin;
use App\Http\Services\product\UploadService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    protected $upload;
    public function __construct(UploadService $upload)
    {
        $this->upload = $upload;
    }

    public function store(Request $request){
            $url = $this->upload->store($request);
            if($url){
                return response()->json([
                    'error'=>false,
                    'url'=> $url
                ]);
            }else{
                return response()->json([
                    'error'=>true
                ]);
            }
    }
}
