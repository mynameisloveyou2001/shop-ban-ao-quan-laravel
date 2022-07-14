<?php

namespace App\Helpers;
class Helper{

    public static function active($active){
        if($active==1){
            echo '<a href="admin/products/editActive/".$value->id>
                Hoạt động
         </a>';
        }else{
            echo '<a href="{{url("admin/products/editActive/".$value["id"])}}">
                Ngưng bán
         </a>';
        }
    }

  public static function menu($categoryList, $parent_id = 0, $char = ''){
    $html = '';

    foreach ($categoryList as $key => $value) {
        if ($value->parent_id == $parent_id) {
            $html .= '
                <tr>
                    <td>'.$value->id.'</td>
                    <td>' .$char .$value->name.'</td>
                    <td>'.$value->active.'</td> 
                    <td>'.$value->updated_at.'</td>
                    <td>
                    <a href="edit/'.$value->id.'", class="btn btn-primary btn-sm">
                    <i class="fas fa-edit"></i></a>
                    <a href="#" onclick="removeRow('.$value->id.',\'delete\')" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            ';

            unset($categoryList[$key]);
            $html .= self::menu($categoryList, $value->id, $char.'-- ');
        }
    }
    return $html;
  }
}

?>