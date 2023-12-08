<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RolesModel extends Model
{
    use HasFactory;

    protected $table = "roles";
    protected $fillable = [
        'name',
        'description'
    ];

    public function getAllBy($limit, $start, $search, $col = null, $dir = null, $where = [])
    {
        $query = $this->select(DB::raw("*"));

        // Add a where clause to filter by model type

        // Apply the limit and offset clauses
        if ($limit) {
            $query->limit($limit);
        }
        if ($start) {
            $query->offset($start);
        }

        // Apply the order by clause
        if ($col && $dir) {
            $query->orderBy($col, $dir);
        }

        // Apply the search criteria
        if (!empty($search)) {
            // $query->orWhere(function ($query) use ($search) {
            //     $i = 0;
            //     foreach ($search as $key => $value) {
            //         if ($i = 0) {
            //             $query->where($key, 'LIKE', "%{$value}%");
            //         } else {
            //             $query->orWhere($key, 'LIKE', "%{$value}%");
            //         }
            //         $i++;
            //     }
            // });
            $searchs = [];
            foreach ($search as $key => $value) {
                $searchs[] = [$key, 'LIKE', "%{$value}%"];
            }

            $query->where($searchs);
        }
        $query->where([['roles.id', '!=', 1]]);

        // Apply the additional where clauses
        if (!empty($where)) {
            $query->where($where);
        }

        // Return the results
        return $query->get();
    }

    public function getCountAllBy($limit, $start, $search, $order, $dir, $where = [])
    {
        $query = $this->select(DB::raw('count(*) as total'));


        if (!empty($search)) {
            // $query->orWhere(function ($query) use ($search) {
            //     $i = 0;
            //     foreach ($search as $key => $value) {
            //         if ($i = 0) {
            //             $query->where($key, 'LIKE', "%{$value}%");
            //         } else {
            //             $query->orWhere($key, 'LIKE', "%{$value}%");
            //         }
            //         $i++;
            //     }
            // });

            $searchs = [];
            foreach ($search as $key => $value) {
                $searchs[] = [$key, 'LIKE', "%{$value}%"];
            }

            $query->where($searchs);
        }
        $query->where([['roles.id', '!=', 1]]);

        return $query->first()->total;
    }
}
