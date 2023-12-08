<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MenuModel extends Model
{
    use HasFactory;

    protected $table = 'menu';
    protected $primaryKey = 'id';

    protected $fillable = [
        'module_id',
        'name',
        'url',
        'parent_id',
        'icon',
        'sequence'
    ];

    public function getMenuSuperadmin($where = [])
    {
        return $this->where($where)->orderBy('sequence')->get();
    }
    public function getMenuPrivileges($where, $order = false)
    {
        $query = DB::table('privileges')
            ->select('menu.*', 'privileges.function_id')
            ->join('menu', 'menu.id', '=', 'privileges.menu_id');

        if ($order) {
            $query->orderBy('menu.sequence');
        }

        $query->where($where);

        $results = $query->get();

        if ($results->count() > 0) {
            return $results;
        } else {
            return false;
        }
    }
    public function getParentIdBy($where = [])
    {
        $query = DB::table('menu')
            ->select('parent_id', 'name')
            ->where($where);

        if ($query->count() > 0) {
            return $query->first();
        }

        return null;
    }

    public function getDetailMenuBy($where = [])
    {
        return DB::table('menu')
            ->select('*')
            ->where($where)
            ->first();
    }
    public function getDataParentByMenus($whereString)
    {
        return DB::select("select id from menu where menu.id IN(
					select parent_id from menu where menu.id IN(" . $whereString . ")
					)");
    }

    public function getAllById($where = [])
    {
        return $this->where($where)->get();
    }

    public function getAllBy($limit, $start, $search, $col = null, $dir = null)
    {
        $query = $this->join('module', 'module.id', '=', 'menu.module_id','LEFT');
        if ($limit) {
            $query->limit($limit);
        }
        if ($start) {
            $query->offset($start);
        }
        if ($col && $dir) {
            $query->orderBy($col, $dir);
        }

        if (!empty($search)) {
            foreach ($search as $key => $value) {
                $query->whereLike($key, $value);
            }
        }

        return $query->get();
    }

    public function getCountAllBy($limit, $start, $search, $order, $dir)
    {
        $query = $this->select('count(*) as total');

        if (!empty($search)) {
            foreach ($search as $key => $value) {
                $query->whereLike($key, $value);
            }
        }

        return $query->first()->total;
    }
}
