<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\MenuModel;
use App\Models\User;
use App\Models\ModelHasRolesModel;
use App\Models\RolesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct(Request $request)
    {
        $this->menu = new MenuModel();
        $this->user = new User();
        $this->model_has_roles = new ModelHasRolesModel();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->data['roles'] = RolesModel::where(['is_deleted' => 0, ['id', '!=', 1]])->get();
        return view('admin.user.list_v', $request->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->data['roles'] = RolesModel::where(['is_deleted' => 0, ['id', '!=', 1]])->get();
        return view('admin.user.create_v', $request->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'role' => 'nullable|string',
            // Validate other additional data fields here
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password, [
                'rounds' => 8,
            ]),
            'phone' => $request->phone_number,
            'address' => $request->address,
            // Set other additional data fields here
        ]);
        $user->assignRole($request->role);

        return redirect()->route('admin.user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $request->data['roles'] = RolesModel::where(['is_deleted' => 0, ['id', '!=', 1]])->get();
        return view('admin.user.create_v', $request->data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {

        $request->data['roles'] = RolesModel::where(['is_deleted' => 0, ['id', '!=', 1]])->get();
        $request->data['datas'] = $this->user->getOneBy(['users.id' => $id]);
        return view('admin.user.edit_v', $request->data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'role' => 'nullable|string',
            // Validate other additional data fields here
        ]);
        $update = $this->user->where(['users.id' => $id])->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
        ]);

        $this->model_has_roles->where(['model_has_roles.model_type' => 'App\Models\User', 'model_has_roles.model_id' => $id]);
        $user = User::find($id);

        $user->attachRole($request->input('role'));
        return redirect()->route('admin.user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $status = $request->input('status');
        $response_data = array();
        $response_data['status'] = false;
        $response_data['msg'] = "";
        $response_data['data'] = array();

        if (!empty($id)) {
            $where = ['users.id' => $id];
            if ($status == 1) {
                $data = ['is_deleted' => 1];
                $update = $this->user->where($where)->update($data);
                $response_data['data'] = $data;
                $response_data['msg'] = "Sukses Menonaktifkan Data";
                $response_data['status'] = true;
            } elseif ($status == 2) {
                $data = ['is_deleted' => 0];
                $update = $this->user->where($where)->update($data);
                $response_data['data'] = $data;
                $response_data['msg'] = "Sukses Mengaktifkan Data";
                $response_data['status'] = true;
            } elseif ($status == 3) {
                $data = ['is_deleted' => 2];
                $update = $this->user->where($where)->update($data);
                $response_data['data'] = $data;
                $response_data['msg'] = "Sukses Menghapus Data";
                $response_data['status'] = true;
            } elseif ($status == 4) {
                $data = ['is_deleted' => 2];
                $delete = $this->user->where($where)->delete($where);
                $where_roles = ['model_has_roles.model_type' => 'App\Models\User', 'model_has_roles.model_id' => $id];
                $delete = $this->model_has_roles->where($where_roles)->delete();
                $response_data['data'] = $data;
                $response_data['msg'] = "Sukses Menghapus Data";
                $response_data['status'] = true;
            }
        } else {
            $response_data['msg'] = "ID Kosong";
        }

        Log::info("user_id => " . $request->data['users']->id . ", function => destroy");
        Log::info("user_id => " . $request->data['users']->id . ", data => " . json_encode($response_data));
        echo json_encode($response_data);
    }
    public function reset_password(Request $request, string $id)
    {
        $response_data = array();
        $response_data['status'] = false;
        $response_data['msg'] = "";
        $response_data['data'] = array();

        if (!empty($id)) {
            $where = ['users.id' => $id];
            $password = '12345678';
            $data = array(
                'password' => Hash::make($password, [
                    'rounds' => 8,
                ]),
            );
            $update = $this->user->where($where)->update($data);
            $response_data['data'] = $data;
            $response_data['msg'] = "Sukses Menonaktifkan Data";
            $response_data['status'] = true;
        } else {
            $response_data['msg'] = "ID Kosong";
        }

        Log::info("user_id => " . $request->data['users']->id . ", function => destroy");
        Log::info("user_id => " . $request->data['users']->id . ", data => " . json_encode($response_data));
        echo json_encode($response_data);
    }

    public function dataList(Request $request)
    {
        $columns = [
            0 => 'users.id',
            1 => 'roles.name',
            2 => 'users.name',
            3 => 'users.email',
            4 => ''
        ];

        $where = [];
        if (!empty($request->post('role_id'))) {
            $where['roles.id'] = $request->post('role_id');
        }
        $order = $columns[$request->post('order')[0]['column']];
        $dir = $request->post('order')[0]['dir'];
        $search = array();
        $limit = 0;
        $start = 0;

        $totalData = $this->user->getCountAllBy($limit, $start, $search, $order, $dir, $where);

        if (!empty($request->post('search')['value'])) {
            $search_value = $request->post('search')['value'];

            if (strtolower($search_value) == "aktif") {
                $where["users.is_deleted"] = 0;
            } elseif (strtolower($search_value) == "nonaktif") {
                $where["users.is_deleted"] = 1;
            } else {
                $search = array(
                    "users.name" => $search_value,
                    "roles.name" => $search_value,
                    "users.email" => $search_value,
                );
            }


            $totalFiltered = $this->user->getCountAllBy($limit, $start, $search, $order, $dir, $where);
        } else {
            $totalFiltered = $totalData;
        }

        $limit = $request->post('length');
        $start = $request->post('start');
        $datas = $this->user->getAllBy($limit, $start, $search, $order, $dir, $where);
        // return $datas;
        $new_data = array();
        if (!empty($datas)) {
            $i = 1;
            foreach ($datas as $key => $data) {
                $create_url = "";
                $edit_url = "";
                $active_url = "";
                $delete_url = "";
                $reset_p_url = "";
                $hard_delete_url = "";

                if ($request->data['is_can_edit'] && $data->is_deleted == 0) {
                    $edit_url = "<a href='" . route('admin.user.edit', ['user' => $data->id]) . "' class='btn btn-sm btn-pill btn-secondary'><i class='fa fa-pencil me-2'></i> Ubah</a>";
                    $reset_p_url = "<a href='#' class='btn btn-sm btn-pill btn-primary reset_password' data-id='" . $data->id . "'  url='" . url('/') . "/admin/user/reset_password/" . $data->id . "'><i class='fa fa-pencil me-2'></i> Reset Password</a>";
                }

                if ($request->data['is_can_active']) {
                    if ($data->is_deleted == 0) {
                        $active_url = "<a href='#' url='" . url('/') . "/admin/user/" . $data->id . "'
                                data-status='1' class='btn btn-sm btn-pill btn-danger delete'><i class='fa fa-lock me-2'></i> NonAktif</a>";
                    } elseif ($data->is_deleted == 1) {
                        $active_url = "<a href='#' url='" . url('/') . "/admin/user/" . $data->id . "'
                            data-status='2' class='btn btn-sm btn-pill btn-success delete'><i class='fa fa-unlock me-2'></i> Aktif</a>";
                    }
                }

                if ($request->data['is_can_delete'] && $data->is_deleted == 1   && $request->data['is_superadmin'] == 1) {
                    $delete_url = "<a href='#' url='" . url('/') . "/admin/user/" . $data->id . "'
                        data-status='3' class='btn btn-sm btn-pill btn-danger delete'><i class='fa fa-trash me-2'></i> Hapus</a>";
                }
                if ($request->data['is_can_delete'] && $data->is_deleted == 2  && $request->data['is_superadmin'] == 1) {
                    $hard_delete_url = "<a href='#' url='" . url('/') . "/admin/user/" . $data->id . "'
                        data-status='4' class='btn btn-sm btn-pill btn-danger delete'><i class='fa fa-trash me-2'></i> Hard Delete</a>";
                }


                if ($data->is_deleted == 0) {
                    $is_deleted = '<span class="badge bg-success">Aktif</span>';
                } elseif ($data->is_deleted == 1) {
                    $is_deleted = '<span class="badge bg-danger">Tidak Aktif</span>';
                } else {
                    $is_deleted = '<span class="badge bg-mute">Dihentikan</span>';
                }
                $nestedData['no'] = $i;
                $i++;

                $nestedData['name'] = '<div class="form-selectgroup-label-content d-flex align-items-center">
                    <div>
                        <div class="text-weight-medium text-wrap text-capitalize">' . $data->name . '</div>
                    </div>
                </div>';
                $nestedData['role_name'] = '<div class="form-selectgroup-label-content d-flex align-items-center">
                    <div>
                        <div class="text-weight-medium text-wrap">' . $data->role_name . '</div>
                    </div>
                </div>';
                $nestedData['email'] = '<div class="form-selectgroup-label-content d-flex align-items-center">
                    <div>
                        <div class="text-weight-medium text-wrap">' . $data->email . '</div>
                    </div>
                </div>';

                $nestedData['is_deleted'] = $is_deleted;

                $nestedData['action'] = '<div class="btn-list flex-nowrap">' . $edit_url . '' . $active_url . '' . $delete_url . '' . $reset_p_url . '' . $hard_delete_url . '</div>';

                $new_data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($request->post('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $new_data,
        );
        Log::info("user_id => " . $request->data['users']->id . ", function => datalist");
        Log::info("user_id => " . $request->data['users']->id . ", data => " . json_encode($json_data));
        echo json_encode($json_data);
    }
}
