<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\FunctionModel;
use App\Models\MenuModel;
use App\Models\User;
use App\Models\ModelHasRolesModel;
use App\Models\PrivilegesModel;
use App\Models\RolesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use stdClass;

class RoleController extends Controller
{
    public function __construct(Request $request)
    {
        $this->menu = new MenuModel();
        $this->user = new User();
        $this->roles = new RolesModel();
        $this->privileges = new PrivilegesModel();
        $this->function_model = new FunctionModel();
        $this->model_has_roles = new ModelHasRolesModel();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->data['roles'] = RolesModel::where(['is_deleted' => 0, ['id', '!=', 1]])->get();
        return view('admin.role.list_v', $request->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('admin.role.create_v', $request->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            // Validate other additional data fields here
        ]);

        $roles = Role::create([
            'name' => $request->name,
            'description' => $request->description,
            // Set other additional data fields here
        ]);

        return redirect()->route('admin.role.index');
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

        // $request->data['roles'] = Roles::where(['is_deleted' => 0, ['id', '!=', 1]])->get();
        $request->data['datas'] = $this->roles->where(['roles.id' => $id])->get()->first();
        return view('admin.role.edit_v', $request->data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            // Validate other additional data fields here
        ]);
        $this->roles->where(['roles.id' => $id])->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('admin.role.index');
    }

    public function privileges(Request $request, string $id)
    {
        $data = $this->roles->all();
        if ($data) {
            foreach ($data as $value) {
                if ($value->id == $id) {
                    $value->selected = "selected";
                } else {
                    $value->selected = "";
                }
            }
            $request->data['datas'] = $data;
            $request->data['id'] = $id;
        } else {
            redirect('role');
        }
        return view('admin.role.privilege_v', $request->data);
    }
    public function privileges_store(Request $request)
    {
        $functions = $request->functions;
        $menus = $request->menus;

        $this->privileges->where(["role_id" => $request->role_id])->delete();
        $data = [];
        $parentMenu = [];
        if ($functions) {
            foreach ($functions as $menu_id => $dataFunction) {
                foreach ($dataFunction as $function_id => $function) {
                    $data[] = array(
                        "menu_id" => $menu_id,
                        "function_id" => $function,
                        "role_id" => $request->role_id,
                    );
                }
                $parentMenu[] = $menu_id;
            }

            $insert = $this->privileges->insert($data);

            $data = array(
                "menu_id" => 1,
                "function_id" => 2,
                "role_id" => $request->role_id,
            );
            $insert = $this->privileges->insert($data);

            $dataParent = $this->menu->getDataParentByMenus(implode(",", $parentMenu));
            // dd($dataParent);
            $data = [];
            foreach ($dataParent as $key => $value) {
                $data[] = array(
                    "menu_id" => $value->id,
                    "function_id" => 2,
                    "role_id" => $request->role_id,
                );
            }
            $this->privileges->insert($data);
        }
        return redirect()->route('admin.role.index');
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
            $where = ['roles.id' => $id];
            if ($status == 1) {
                $data = ['is_deleted' => 1];
                $update = $this->roles->where($where)->update($data);
                $response_data['data'] = $data;
                $response_data['msg'] = "Sukses Menonaktifkan Data";
                $response_data['status'] = true;
            } elseif ($status == 2) {
                $data = ['is_deleted' => 0];
                $update = $this->roles->where($where)->update($data);
                $response_data['data'] = $data;
                $response_data['msg'] = "Sukses Mengaktifkan Data";
                $response_data['status'] = true;
            } elseif ($status == 3) {
                $data = ['is_deleted' => 2];
                $update = $this->roles->where($where)->update($data);
                $response_data['data'] = $data;
                $response_data['msg'] = "Sukses Menghapus Data";
                $response_data['status'] = true;
            } elseif ($status == 4) {
                $data = ['is_deleted' => 2];
                $delete = $this->roles->where($where)->delete();
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

    public function dataList(Request $request)
    {
        $columns = [
            0 => 'roles.name',
            1 => 'roles.is_deletes',
            2 => ''
        ];

        $where = [];
        $order = $columns[$request->post('order')[0]['column']];
        $dir = $request->post('order')[0]['dir'];
        $search = array();
        $limit = 0;
        $start = 0;

        $totalData = $this->roles->getCountAllBy($limit, $start, $search, $order, $dir, $where);

        if (!empty($request->post('search')['value'])) {
            $search_value = $request->post('search')['value'];

            if (strtolower($search_value) == "aktif") {
                $where["roles.is_deleted"] = 0;
            } elseif (strtolower($search_value) == "nonaktif") {
                $where["roles.is_deleted"] = 1;
            } else {
                $search = array(
                    "roles.name" => $search_value,
                );
            }


            $totalFiltered = $this->roles->getCountAllBy($limit, $start, $search, $order, $dir, $where);
        } else {
            $totalFiltered = $totalData;
        }

        $limit = $request->post('length');
        $start = $request->post('start');
        $datas = $this->roles->getAllBy($limit, $start, $search, $order, $dir, $where);
        // dd($where);
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
                    $edit_url = "<a href='" . route('admin.role.edit', [$data->id]) . "' class='btn btn-primary btn-sm mr-2'><i class='fa fa-pencil me-2'></i> Ubah</a>";
                }

                if ($request->data['is_can_active']) {
                    if ($data->is_deleted == 0) {
                        $active_url = "<a href='#' url='" . route('admin.role.destroy', [$data->id]) . "'
                                data-status='1' class='btn btn-danger btn-sm mr-2 delete'><i class='fa fa-lock me-2'></i> NonAktif</a>";
                    } elseif ($data->is_deleted == 1) {
                        $active_url = "<a href='#' url='" . route('admin.role.destroy', [$data->id])  . "'
                            data-status='2' class='btn btn-success btn-sm mr-2 delete'><i class='fa fa-unlock me-2'></i> Aktif</a>";
                    }
                }

                if ($request->data['is_can_delete'] && $data->is_deleted == 1   && $request->data['is_superadmin'] == 1) {
                    $delete_url = "<a href='#' url='" . route('admin.role.destroy', [$data->id])  . "'
                        data-status='3' class='btn btn-danger btn-sm mr-2 delete'><i class='fa fa-trash me-2'></i> Hapus</a>";
                }
                if ($request->data['is_can_delete'] && $data->is_deleted == 2  && $request->data['is_superadmin'] == 1) {
                    $hard_delete_url = "<a href='#' url='" . route('admin.role.destroy', [$data->id])  . "'
                        data-status='4' class='btn btn-danger btn-sm mr-2 delete'><i class='fa fa-trash me-2'></i> Hard Delete</a>";
                }

                if ($request->data['is_can_access'] && ($data->is_deleted == 0 || $data->is_deleted == 3)) {
                    $privilege_url = "<a href='" . route('admin.role.privileges', [$data->id]) . "' class='btn btn-sm btn-primary mr-2'><i class='fa fa-cogs me-2'></i> Hak Akses</a>";
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

                $nestedData['name'] = $data->name;

                $nestedData['is_deleted'] = $is_deleted;

                $nestedData['action'] = '<div class="btn-list flex-nowrap">' . $edit_url . '' . $privilege_url  . '' . $active_url . '' . $delete_url . '' . $hard_delete_url . '</div>';

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

    private function isMenuSelected($menu_selecteds, $menu)
    {
        foreach ($menu_selecteds as $key => $value) {
            if ($menu['id'] == $value['menu_id'] && count($value['functions']) == count($menu['functions'])) {
                return true;
            }
        }
        return false;
    }

    private function isMenuFunctionSelected($menu_selecteds, $menu_id, $function_id)
    {
        foreach ($menu_selecteds as $key => $menus) {
            if ($menu_id == $menus['menu_id']) {
                foreach ($menus['functions'] as $key => $function) {
                    if ($function_id == $function['id']) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

    public function getPrivillege(Request $request)
    {

        $id = $request->input('id');
        $menus = $this->menu->all();
        $functions = $this->function_model->getAllMenuFunction();
        $dataMenus = array();
        foreach ($functions as $key => $function) {
            $dataMenus[$function->id]["id"] = $function->id;
            $dataMenus[$function->id]["name"] = $function->name;
            $dataMenus[$function->id]["description"] = $function->description;
            $dataMenus[$function->id]["functions"][] = array(
                "id" => $function->function_id,
                "name" => $function->function_name,
            );
        }

        $menus = $dataMenus;
        $data = $this->privileges->getOneBy(["roles.id" => $id]);
        $roles = $this->roles->where(["roles.id" => $id])->get()->first();
        // dd($data->first());
        $role_name = (!empty($roles)) ? $roles->name : "";

        $dataMenus = array();
        // dd($data);
        if ($data->count() > 0) {
            foreach ($data as $key => $function) {
                $dataMenus[$function->menu_id]["menu_id"] = $function->menu_id;
                $dataMenus[$function->menu_id]["functions"][]['id'] = $function->function_id;
            }
        }
        $menu_selecteds = $dataMenus;
        $data = [];

        // echo "<pre>";
        foreach ($menus as $key => $data_menu) {
            // print_r($data_menu);
            $x = new stdClass();
            $x->id = $data_menu['id'];
            $x->checked = $this->isMenuSelected($menu_selecteds, $data_menu) ? "checked" : "";
            $x->name = $data_menu['name'];
            $x->description = $data_menu['description'];

            //fungsi selected
            $fungsi = [];
            foreach ($data_menu['functions'] as $function) {
                $y = new stdClass();
                $y->id = $function['id'];
                $y->name = $function['name'];
                $y->checked = $this->isMenuFunctionSelected($menu_selecteds, $data_menu['id'], $function['id']) ? "checked" : "";
                array_push($fungsi, $y);
            }
            $x->fungsi = $fungsi;
            array_push($data, $x);
        }

        if (!empty($data)) {
            $response_data['status'] = true;
            $response_data['data'] = $data;
            $response_data['role_id'] = $id;
            $response_data['role_name'] = $role_name;
            $response_data['message'] = "Berhasil Mengambil Data";
        } else {
            $response_data['status'] = false;
            $response_data['data'] = [];
            $response_data['role_id'] = [];
            $response_data['role_name'] = [];
            $response_data['message'] = "Gagal Mengambil Data";
        }

        echo json_encode($response_data);
    }
}
