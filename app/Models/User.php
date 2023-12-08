<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];
    public function getOneBy($where = [])
    {
        $query = $this->select(DB::raw("users.id, users.name, users.email, users.is_deleted,users.phone,users.address, roles.name as role_name,roles.id as role_id"));
        $query->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id', 'LEFT');
        $query->join('roles', 'model_has_roles.role_id', '=', 'roles.id', 'LEFT');
        $query->where(['model_has_roles.model_type' => 'App\Models\User', ['users.id', '!=', 1]]);

        // Apply the additional where clauses
        if (!empty($where)) {
            $query->where($where);
        }

        // Return the results
        return $query->get()->first();
    }

    public function getAllBy($limit, $start, $search, $col = null, $dir = null, $where = [])
    {
        $query = $this->select(DB::raw("users.id, users.name, users.email, users.is_deleted, roles.name as role_name"));
        $query->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id', 'LEFT');
        $query->join('roles', 'model_has_roles.role_id', '=', 'roles.id', 'LEFT');

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
        $query->where(['model_has_roles.model_type' => 'App\Models\User', ['users.id', '!=', 1]]);

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
        $query->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id', 'LEFT');
        $query->join('roles', 'model_has_roles.role_id', '=', 'roles.id', 'LEFT');


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
        $query->where(['model_has_roles.model_type' => 'App\Models\User', ['users.id', '!=', 1]]);

        return $query->first()->total;
    }
}
