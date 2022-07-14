<?php

namespace App\Http\Services\product;
use App\Models\Menu;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

class ProductAdminServices{
    public function getMenu(){
        return Menu::where('active',1)->get();
    }


    public function isValidPrice($request){
        if ($request['price'] != 0 && $request['price_sale'] != 0 && $request['price_sale'] >= $request['price']) {
            Session::flash('error','Giá bán phải nhỏ hơn giá gốc');
            return false;
        }
        if($request['price_sale'] != 0 && $request['price'] == 0){
            Session::flash('error','Vui lòng nhập giá gốc');
            return false;
        }

        return true;
    }

    public function insert($request){
        $isvalidPrice = $this->isValidPrice($request);
        if ($isvalidPrice == false) {
            return false;
        }   
        try {
            $request->except('_token');
            // unset($request['_token']);
            Product::create($request->all());
            Session::flash('success','Thêm sản phẩm thành công!!!');
        } catch (\Throwable $th) {
            Session::flash('error','Thêm sản phẩm thất bại!!');
            return false;
        }
        return true;
    }

    public function getProducts(){
        return Product::with('menu')->orderByDesc('id')->paginate(15);
    }
    

    public function delete($request){
        $id = $request['id'];
        $product = Product::where('id',$id)->first();
        if ($product) {
            $product->delete();
            return true;
        }
        return false;
    }

    public function update($request, $product){
        if(!empty($request['price']) && !empty($request['price_sale'])){
            $isvalidPrice = $this->isValidPrice($request);
            if($isvalidPrice == false) return false;
        }
        try {
            $product->fill($request->input());
            $product->save();
            Session::flash('success','Cập nhật thành công!!');
        } catch (\Throwable $th) {
            Session::flash('error','Cập nhật thất bại!!');
            return false;
        }
        return true;
    }
}
