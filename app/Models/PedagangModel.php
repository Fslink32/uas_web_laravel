<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PedagangModel extends Model
{
    use HasFactory;

    protected $table = "pedagang";

    protected $fillable = [
        'nama_pemilik',
        'nama_toko',
        'komoditas',
        'lantai',
        'block',
        'nomor',
    ];

    public function getAllBy($limit, $start, $search, $col = null, $dir = null, $where = [])
    {
        $query = $this->select(DB::raw("pedagang.*"));

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
            foreach ($search as $key => $value) {
                // $searchs[] = [$key,'=', "%{$value}%"];
                $query->orWhere($key, 'LIKE', "%{$value}%");
            }
        }

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
            foreach ($search as $key => $value) {
                $query->orWhere($key, 'LIKE', "%{$value}%");
            }
        }

        if (!empty($where)) {
            $query->where($where);
        }

        return $query->first()->total;
    }
}
