<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PrivilegesModel extends Model
{
    use HasFactory;

    protected $table = "privileges";

    public static function getOneBy(array $where = [])
    {
        $query = DB::table('privileges')->select(DB::raw("*,roles.name as role_name,menu.description"))
            ->join('roles', 'roles.id', '=', 'privileges.role_id', 'LEFT')
            ->join('menu', 'menu.id', '=', 'privileges.menu_id', 'LEFT')
            ->where('roles.is_deleted', '=', 0);
        if (!empty($where)) {
            $query->where($where);
        }
        return $query->get();
        // $this->db->select("*,roles.name as role_name,menu.description")
        //         ->from("privileges");
        // $this->db->join("roles","roles.id = privileges.role_id","left");
        // $this->db->join("menu","menu.id = privileges.menu_id","left");
        // $this->db->where("roles.is_deleted",0);
        // $this->db->where($where);
        // $query = $this->db->get();
        // if ($query->num_rows() >0){
        //     return $query->result();
        // }
        // return FALSE;
    }


    /**
     * Update an existing privileges.
     *
     * @param array $data
     * @param array $where
     * @return int
     */

    /**
     * Insert a batch of new privilegess.
     *
     * @param array $data
     * @return void
     */
    public static function insertBatch(array $data)
    {
        Privileges::insert($data);
    }
}
