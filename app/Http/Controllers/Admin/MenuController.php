<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Services\Menu\MenuService;
use App\Models\Menu;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    protected $menuService;
    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function create(){
        return view('admin.menu.add',[
            'title' => 'Thêm Danh Mục Mới',
            'categoryList'=>$this->menuService->getParent()
        ]);
    }

    public function store(CreateFormRequest $request){
        $this->menuService->create($request);
        return redirect()->route('list');
    }


    public function index(){
        return view('admin.menu.index',[
            'title'=>'Danh Sách Danh Mục',
            'categoryList'=> $this->menuService->getCategoryForIndex()
        ]);
    }

    public function show(Menu $menu){
        return view('admin.menu.edit',
        ['title'=>'Chỉnh sửa danh mục',
        'categoryList'=>$this->menuService->getParent()
        ,'category'=>Menu::where('id',$menu['id'])->first()]);
    }

    public function update(Menu $menu, CreateFormRequest $request){
        $this->menuService->update($menu,$request);
        return redirect('admin/menus/list');
    }


    public function destroy(Request $request):JsonResponse
    {
        $result = $this->menuService->delete($request);
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
