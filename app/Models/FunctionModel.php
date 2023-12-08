<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FunctionModel extends Model
{
    use HasFactory;

    protected $table = 'function';
    function getAllMenuFunction()
    {
        return DB::table('menu_function')->select(DB::raw("menu.id,menu.name,menu.description,menu.show_at, function.name as function_name,function.id as function_id"))
        ->join('menu','menu.id','=','menu_function.menu_id')
        ->join('function','function.id','=','menu_function.function_id')
        ->orderBy('menu.parent_id', 'ASC')
        ->orderBy('menu.sequence', "ASC")
        ->where('parent_id','!=',0)
        ->where('url','!=','#')
        ->get();
    }
}
