<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\HargaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HargaController extends Controller
{
    public function __construct(Request $request)
    {
        $this->harga = new HargaModel();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd(session('message'));
        return view('admin.harga.list_v', $request->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('admin.harga.create_v', $request->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->input());
        $request->validate([
            'nama_barang' => 'required',
            'satuan' => 'required',
            'harga' => 'required',
        ]);
        $data = [
            'nama_barang' => $request->input('nama_barang'),
            'satuan' => $request->input('satuan'),
            'harga' => $request->input('harga'),
        ];
        $create = HargaModel::create($data);

        if ($create) {
            session()->flash('message', 'Harga berhasil dibuat');
        } else {
            session()->flash('message_error', 'Harga gagal dibuat');
        }
        return redirect()->route('admin.harga.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        $request->data['datas'] = HargaModel::find($id);
        return view('admin.harga.edit_v', $request->data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_barang' => 'required',
            'satuan' => 'required',
            'harga' => 'required',
        ]);
        $data = [
            'nama_barang' => $request->input('nama_barang'),
            'satuan' => $request->input('satuan'),
            'harga' => $request->input('harga'),
        ];
        $create = HargaModel::where(['id'=>$id])->update($data);

        if ($create) {
            session()->flash('message', 'Harga berhasil diedit');
        } else {
            session()->flash('message_error', 'Harga gagal diedit');
        }
        return redirect()->route('admin.harga.index');
    }

    public function destroy(Request $request, string $id)
    {
        $status = $request->input('status');
        $response_data = array();
        $response_data['status'] = false;
        $response_data['msg'] = "";
        $response_data['data'] = array();

        if (!empty($id)) {
            $where = ['id' => $id];
            $delete = HargaModel::where($where)->delete($where);
            $response_data['data'] = $delete;
            $response_data['msg'] = "Sukses Menghapus Data";
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
            0 => 'harga.id',
            1 => 'harga.nama_barang',
            2 => 'harga.satuan',
            3 => 'harga.harga',
            4 => ''
        ];

        $where = [];
        $order = $columns[$request->post('order')[0]['column']];
        $dir = $request->post('order')[0]['dir'];
        $search = array();
        $limit = 0;
        $start = 0;

        $totalData = $this->harga->getCountAllBy($limit, $start, $search, $order, $dir, $where);

        if (!empty($request->post('search')['value'])) {
            $search_value = $request->post('search')['value'];

            $search = array(
                "harga.nama_barang" => $search_value,
                "harga.satuan" => $search_value,
                "harga.harga" => $search_value,
            );


            $totalFiltered = $this->harga->getCountAllBy($limit, $start, $search, $order, $dir, $where);
        } else {
            $totalFiltered = $totalData;
        }

        $limit = $request->post('length');
        $start = $request->post('start');
        $datas = $this->harga->getAllBy($limit, $start, $search, $order, $dir, $where);
        // return $datas;
        $new_data = array();
        if (!empty($datas)) {
            $i = 1;
            foreach ($datas as $key => $data) {
                $create_url = "";
                $edit_url = "";
                $verif_url = "";
                $active_url = "";
                $delete_url = "";
                $hard_delete_url = "";

                if ($request->data['is_can_edit'] && $data->is_deleted == 0) {
                    $edit_url = "<a href='" . route('admin.harga.edit', [$data->id]) . "' class='btn btn-sm btn-pill btn-secondary'><i class='fa fa-pencil me-2'></i> Ubah</a>";
                }

                if ($request->data['is_can_active']) {
                    if ($data->is_deleted == 0) {
                        $active_url = "<a href='#' url='" . url('/') . "/admin/harga/" . $data->id . "'
                                data-status='1' class='btn btn-sm btn-pill btn-danger delete'><i class='fa fa-lock me-2'></i> NonAktif</a>";
                    } elseif ($data->is_deleted == 1) {
                        $active_url = "<a href='#' url='" . url('/') . "/admin/harga/" . $data->id . "'
                            data-status='2' class='btn btn-sm btn-pill btn-success delete'><i class='fa fa-unlock me-2'></i> Aktif</a>";
                    }
                }

                if ($request->data['is_can_delete'] && $data->is_deleted == 1   && $request->data['is_superadmin'] == 1) {
                    $delete_url = "<a href='#' url='" . url('/') . "/admin/harga/" . $data->id . "'
                        data-status='3' class='btn btn-sm btn-pill btn-danger delete'><i class='fa fa-trash me-2'></i> Hapus</a>";
                }
                if ($request->data['is_can_delete'] && $data->is_deleted == 2  && $request->data['is_superadmin'] == 1) {
                    $hard_delete_url = "<a href='#' url='" . url('/') . "/admin/harga/" . $data->id . "'
                        data-status='4' class='btn btn-sm btn-pill btn-danger delete'><i class='fa fa-trash me-2'></i> Hard Delete</a>";
                }
                $nestedData['no'] = $i;
                $i++;

                $nestedData['nama_barang'] = $data->nama_barang;
                $nestedData['satuan'] = $data->satuan;
                $nestedData['harga'] = $data->harga;

                $nestedData['action'] = '<div class="btn-list flex-nowrap">' .$edit_url . '' . $active_url . '' . $delete_url  . '' . $hard_delete_url . '</div>';

                $new_data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($request->post('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $new_data,
        );
        Log::info("users_id => " . $request->data['users']->id . ", function => datalist");
        Log::info("users_id => " . $request->data['users']->id . ", data => " . json_encode($json_data));
        echo json_encode($json_data);
    }
}
