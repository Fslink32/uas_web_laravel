<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\PedagangModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PedagangController extends Controller
{
    public function __construct(Request $request)
    {
        $this->pedagang = new PedagangModel();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd(session('message'));
        return view('admin.pedagang.list_v', $request->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('admin.pedagang.create_v', $request->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->input());
        $request->validate([
            'nama_pemilik' => 'required',
            'nama_toko' => 'required',
            'komoditas' => 'required',
            'lantai' => 'required',
            'block' => 'required',
            'nomor' => 'required',
        ]);
        $data = [
            'nama_pemilik' => $request->input('nama_pemilik'),
            'nama_toko' => $request->input('nama_toko'),
            'komoditas' => $request->input('komoditas'),
            'lantai' => $request->input('lantai'),
            'block' => $request->input('block'),
            'nomor' => $request->input('nomor'),
        ];
        $create = PedagangModel::create($data);

        if ($create) {
            session()->flash('message', 'Pedagang berhasil dibuat');
        } else {
            session()->flash('message_error', 'Pedagang gagal dibuat');
        }
        return redirect()->route('admin.pedagang.index');
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
        $request->data['datas'] = PedagangModel::find($id);
        return view('admin.pedagang.edit_v', $request->data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_pemilik' => 'required',
            'nama_toko' => 'required',
            'komoditas' => 'required',
            'lantai' => 'required',
            'block' => 'required',
            'nomor' => 'required',
        ]);
        $data = [
            'nama_pemilik' => $request->input('nama_pemilik'),
            'nama_toko' => $request->input('nama_toko'),
            'komoditas' => $request->input('komoditas'),
            'lantai' => $request->input('lantai'),
            'block' => $request->input('block'),
            'nomor' => $request->input('nomor'),
        ];
        $create = PedagangModel::where(['id'=>$id])->update($data);

        if ($create) {
            session()->flash('message', 'Pedagang berhasil diedit');
        } else {
            session()->flash('message_error', 'Pedagang gagal diedit');
        }
        return redirect()->route('admin.pedagang.index');
    }

    public function verifikasi(Request $request, string $id)
    {
        $request->data['datas'] = PedagangModel::find($id);
        return view('admin.pedagang.verifikasi_v', $request->data);
    }

    public function verifikasi_update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required',
        ]);

        $create = PedagangModel::where(['id' => $id])->update([
            'status' => $request->input('status'),
        ]);

        if ($create) {
            if ($request->input('status') == "1") {
                session()->flash('message', 'Project berhasil diverifikasi');
            } elseif ($request->input('status') == "2") {
                session()->flash('message', 'Project berhasil ditolak');
            }
        } else {
            session()->flash('message_error', 'Project gagal diverifikasi');
        }
        return response('Berhasil di update', 200);
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
            $where = ['id' => $id];
            $delete = PedagangModel::where($where)->delete($where);
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
            0 => 'pedagang.id',
            1 => 'pedagang.nama_pemilik',
            2 => 'pedagang.nama_toko',
            3 => 'pedagang.komoditas',
            4 => 'pedagang.lantai',
            5 => 'pedagang.block',
            6 => 'pedagang.nomor',
            7 => ''
        ];

        $where = [];
        $order = $columns[$request->post('order')[0]['column']];
        $dir = $request->post('order')[0]['dir'];
        $search = array();
        $limit = 0;
        $start = 0;

        $totalData = $this->pedagang->getCountAllBy($limit, $start, $search, $order, $dir, $where);

        if (!empty($request->post('search')['value'])) {
            $search_value = $request->post('search')['value'];

            $search = array(
                "pedagang.nama_pemilik" => $search_value,
                "pedagang.nama_toko" => $search_value,
                "pedagang.komoditas" => $search_value,
                "pedagang.lantai" => $search_value,
                "pedagang.block" => $search_value,
                "pedagang.nomor" => $search_value,
            );


            $totalFiltered = $this->pedagang->getCountAllBy($limit, $start, $search, $order, $dir, $where);
        } else {
            $totalFiltered = $totalData;
        }

        $limit = $request->post('length');
        $start = $request->post('start');
        $datas = $this->pedagang->getAllBy($limit, $start, $search, $order, $dir, $where);
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
                    $edit_url = "<a href='" . route('admin.pedagang.edit', [$data->id]) . "' class='btn btn-sm btn-pill btn-secondary'><i class='fa fa-pencil me-2'></i> Ubah</a>";
                }

                if ($request->data['is_can_active']) {
                    if ($data->is_deleted == 0) {
                        $active_url = "<a href='#' url='" . url('/') . "/admin/pedagang/" . $data->id . "'
                                data-status='1' class='btn btn-sm btn-pill btn-danger delete'><i class='fa fa-lock me-2'></i> NonAktif</a>";
                    } elseif ($data->is_deleted == 1) {
                        $active_url = "<a href='#' url='" . url('/') . "/admin/pedagang/" . $data->id . "'
                            data-status='2' class='btn btn-sm btn-pill btn-success delete'><i class='fa fa-unlock me-2'></i> Aktif</a>";
                    }
                }

                if ($request->data['is_can_delete'] && $data->is_deleted == 1   && $request->data['is_superadmin'] == 1) {
                    $delete_url = "<a href='#' url='" . url('/') . "/admin/pedagang/" . $data->id . "'
                        data-status='3' class='btn btn-sm btn-pill btn-danger delete'><i class='fa fa-trash me-2'></i> Hapus</a>";
                }
                if ($request->data['is_can_delete'] && $data->is_deleted == 2  && $request->data['is_superadmin'] == 1) {
                    $hard_delete_url = "<a href='#' url='" . url('/') . "/admin/pedagang/" . $data->id . "'
                        data-status='4' class='btn btn-sm btn-pill btn-danger delete'><i class='fa fa-trash me-2'></i> Hard Delete</a>";
                }
                $nestedData['no'] = $i;
                $i++;

                $nestedData['nama_pemilik'] = $data->nama_pemilik;
                $nestedData['nama_toko'] = $data->nama_toko;
                $nestedData['komoditas'] = $data->komoditas;
                $nestedData['lantai'] = $data->lantai;
                $nestedData['block'] = $data->block;
                $nestedData['nomor'] = $data->nomor;

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
