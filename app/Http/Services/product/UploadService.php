<?php
namespace App\Http\Services\product;

use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
class UploadService {

    public function store($request){
        if ($request->hasFile('file')) {
            try{
                $name = $request->file('file')->getClientOriginalName();
                $request->file('file')->storeAs('public/uploads',$name);
                return '/storage/uploads/'.$name;
            }catch(\Exception $error){
                return false;
            }
        }
        return "Lỗi upload";
    }
}
?>