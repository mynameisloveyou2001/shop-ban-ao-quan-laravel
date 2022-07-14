<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Services\product\ProductAdminServices;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use PhpParser\JsonDecoder;

class ProductController extends Controller
{

    protected $productServices;
    public function __construct(ProductAdminServices $productServices)
    {
        $this->productServices = $productServices;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.products.index',['title'=>'Danh sách sản phẩm','products'=>$this->productServices->getProducts()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Thêm mới sản phẩm';
        $menu = $this->productServices->getMenu();
        return view('admin.products.add',['title'=>$title,'menu'=>$menu]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $this->productServices->insert($request);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $menu = $this->productServices->getMenu();
        $product = Product::with('menu')->find($product)->first();
        // echo $product['thumb'];
        // die;
        return view('admin.products.edit',['title'=>'Cập nhật sản phẩm',
        'product'=>$product,'menu'=>$menu]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
       $result = $this->productServices->update($request, $product);
       if($result){
           return redirect('admin/products/list');
       }
        return redirect()->back();
    }

    public function editAcitve(Request $request,Product $product){
        
        $request['active']+=$product['active'];
        if($request['active']==1){
            $request['active']=0;
        }else{
            $request['active']=1;
        }
        $result = $this->productServices->update($request, $product);
        if($result){
            return redirect('admin/products/list');
        }
         return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request):JsonResponse
    {
        $result = $this->productServices->delete($request);
        if ($result) {
            return response()->json(
            [                
                'error' => false,
                'message'=> 'Xóa thành công!']
            );
        }else{
            return response()->json(
                [                
                    'error' => true,
                ]
                );   
        }
    }
}
