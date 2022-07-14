<?php
namespace App\Http\Services\Menu;

use App\Models\Menu;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class MenuService{

    public function getParent(){
        return Menu::where('parent_id',0)->get();
    }

    public function getCategoryForIndex(){
        return Menu::orderByDesc('id')->paginate(10);
    }

    public function create($request){
        try {
            Menu::create([
                'name'=> (string) $request['name'],
                'parent_id'=> (string) $request['parent_id'],
                'description'=> (string) $request['description'],
                'content'=> (string) $request['content'],
                'active'=> (string) $request['active'],
            ]);
           Session::flash('success','Danh mục đã được tạo');
        } catch (\Throwable $th) {
           Session::flash('error',$th->getMessage());
           return false;
        }
        return true;
    }

    public function delete($request){
        $id = $request['id'];
        $category = Menu::where('id',$id)->first();
        if ($category) {
            Menu::where('id',$id)->orWhere('parent_id',$id)->delete();
            return true;
        }
        return false;
    }

    public function update($menu, $request){
        if($menu->parent_id != $request['parent_id']){
            $menu->parent_id = $request['parent_id'];
        }
        $menu->name=$request['name'];
        $menu->description=$request['description'];
        $menu->content=$request['content'];
        $menu->active=$request['active'];
        $menu->save();
        Session::flash('success','Cập nhật thành công');
        return true;
    }

}

?>