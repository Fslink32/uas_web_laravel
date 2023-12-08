<?php

namespace App\Http\Core;

use Closure;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Privileges;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin_Controller extends Controller
{
	// public $hallo;
	public function __construct(Request $request)
	{
		$this->middleware('auth');
		$this->middleware(function ($request, $next) {
			$this->first($request);
			return $next($request);
		});
	}
	public function first(Request $request)
	{

		// parent::__construct($request);
		DB::statement('SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode,"ONLY_FULL_GROUP_BY",""))');
		if (!auth()->check()) {
			// redirect('auth/login', 'refresh');
			redirect()->route('welcome');
		} else {
			$this->data['users'] = auth()->user();
			$this->data['users_groups'] = auth()->user()->roles->first();
		}

		$this->make_dir_upload();
		$this->data['page'] = "";
		$this->data['parent_page_name'] = "";
		$this->data['page_id'] = "";
		$this->data['is_superadmin'] = false;
		$this->data['is_can_create'] = false;
		$this->data['is_can_read'] = false;
		$this->data['is_can_edit'] = false;
		$this->data['is_can_delete'] = false;
		$this->data['is_can_active'] = false;
		$this->data['is_can_access'] = false;
		$this->data['is_can_download'] = false;
		$this->data['is_can_upload'] = false;
		$this->data['is_can_approval'] = false;
		$this->data['is_can_approval_unit'] = true;
		$this->data['is_can_approval_avp'] = true;
		$this->data['is_can_approval_vp'] = true;
		$this->data['is_can_kpi'] = false;
		$this->data['is_can_rkapk'] = false;
		$this->data['is_can_rkapp'] = false;
		$this->data['is_can_rjppk'] = false;
		$this->data['is_can_rjppp'] = false;
		$this->data['is_can_evaluasi'] = false;
		$this->data['is_can_marketing'] = false;
		$this->data['is_can_tantangan'] = false;
		$this->data['is_can_portofolio'] = false;
		$this->data['is_can_adjusment'] = false;
		$this->data['is_can_rekap_prognosa'] = false;
		$this->data['is_can_rekap_portofolio'] = false;
		$this->data['is_can_verifikasi'] = false;
		$this->data['is_can_rencana_rkap'] = false;
		$this->data['is_can_real_rate'] = false;

		$this->menu_model = new Menu();

		if (auth()->user()->hasRole('superadmin')) {
			$this->data['is_superadmin'] = true;
		}

		if (!$request->ajax()) {
			$this->data['menu'] = $this->loadMenu();
		} else {
			$this->data['page_id'] = session('page_id');
		}

		if ($this->data['is_superadmin']) {
			$this->data['is_can_create'] = true;
			$this->data['is_can_read'] = true;
			$this->data['is_can_edit'] = true;
			$this->data['is_can_delete'] = true;
			$this->data['is_can_active'] = true;
			$this->data['is_can_access'] = true;
			$this->data['is_can_download'] = true;
			$this->data['is_can_upload'] = true;
			$this->data['is_can_approval'] = true;
			$this->data['is_can_approval_unit'] = true;
			$this->data['is_can_approval_avp'] = true;
			$this->data['is_can_approval_vp'] = true;
			$this->data['is_can_kpi'] = true;
			$this->data['is_can_rkapk'] = true;
			$this->data['is_can_rkapp'] = true;
			$this->data['is_can_rjppk'] = true;
			$this->data['is_can_rjppp'] = true;
			$this->data['is_can_evaluasi'] = true;
			$this->data['is_can_marketing'] = true;
			$this->data['is_can_tantangan'] = true;
			$this->data['is_can_portofolio'] = true;
			$this->data['is_can_adjusment'] = true;
			$this->data['is_can_rekap_prognosa'] = true;
			$this->data['is_can_rekap_portofolio'] = true;
			$this->data['is_can_verifikasi'] = true;
			$this->data['is_can_rencana_rkap'] = true;
			$this->data['is_can_real_rate'] = true;
		} else {

			$this->privileges_model = new Privileges();
			if ($this->data['users_groups']) {
				$where = [
					"menu_id" => $this->data['page_id'],
					"role_id" => $this->data['users_groups']->id,
				];
				$dataPrivileges = $this->privileges_model->getOneBy($where);
				// var_dump($dataPrivileges);exit;
				$this->data['is_can_create'] = ($this->isInPrivileges($dataPrivileges, 1));
				$this->data['is_can_read'] = ($this->isInPrivileges($dataPrivileges, 2));
				$this->data['is_can_edit'] = ($this->isInPrivileges($dataPrivileges, 3));
				$this->data['is_can_delete'] = ($this->isInPrivileges($dataPrivileges, 4));
				$this->data['is_can_active'] = ($this->isInPrivileges($dataPrivileges, 5));
				$this->data['is_can_access'] = ($this->isInPrivileges($dataPrivileges, 6));
				$this->data['is_can_download'] = ($this->isInPrivileges($dataPrivileges, 7));
				$this->data['is_can_upload'] = ($this->isInPrivileges($dataPrivileges, 8));
				$this->data['is_can_approval'] = ($this->isInPrivileges($dataPrivileges, 9));
				$this->data['is_can_approval_unit'] = ($this->isInPrivileges($dataPrivileges, 10));
				$this->data['is_can_approval_avp'] = ($this->isInPrivileges($dataPrivileges, 11));
				$this->data['is_can_approval_vp'] = ($this->isInPrivileges($dataPrivileges, 12));
				$this->data['is_can_kpi'] = ($this->isInPrivileges($dataPrivileges, 13));
				$this->data['is_can_rkapk'] = ($this->isInPrivileges($dataPrivileges, 14));
				$this->data['is_can_rkapp'] = ($this->isInPrivileges($dataPrivileges, 15));
				$this->data['is_can_rjppk'] = ($this->isInPrivileges($dataPrivileges, 16));
				$this->data['is_can_rjppp'] = ($this->isInPrivileges($dataPrivileges, 17));
				$this->data['is_can_evaluasi'] = ($this->isInPrivileges($dataPrivileges, 18));
				$this->data['is_can_marketing'] = ($this->isInPrivileges($dataPrivileges, 19));
				$this->data['is_can_tantangan'] = ($this->isInPrivileges($dataPrivileges, 20));
				$this->data['is_can_portofolio'] = ($this->isInPrivileges($dataPrivileges, 21));
				$this->data['is_can_adjusment'] = ($this->isInPrivileges($dataPrivileges, 22));
				$this->data['is_can_rekap_prognosa'] = ($this->isInPrivileges($dataPrivileges, 23));
				$this->data['is_can_rekap_portofolio'] = ($this->isInPrivileges($dataPrivileges, 24));
				$this->data['is_can_verifikasi'] = ($this->isInPrivileges($dataPrivileges, 25));
				$this->data['is_can_rencana_rkap'] = ($this->isInPrivileges($dataPrivileges, 26));
				$this->data['is_can_real_rate'] = ($this->isInPrivileges($dataPrivileges, 27));
			}
		}

		// $this->autoMigrate();
		// $this->cleanTmp();
	}

	private function make_dir_upload()
	{
		$dirs = [
			'./uploaded/',
		];

		foreach ($dirs as $dir) {
			if (!is_dir($dir)) {
				mkdir($dir, 0777, TRUE);
			}
		}
	}

	private function isInPrivileges($data, $id)
	{
		if (!empty($data)) {
			for ($i = 0; $i < count($data); $i++) {
				if (isset($data[$i]) && $data[$i]->function_id == $id) {
					return true;
				}
			}
		}

		return false;
	}

	private function createTree($parent, $menu, $parent_id, $path_active_name)
	{
		$html = "";
		if (isset($menu['parents'][$parent])) {
			$show = "";
			foreach ($menu['parents'][$parent] as $itemId) {
				$id = $menu['items'][$itemId]['id'];
				if ($id == $parent_id || $parent == $parent_id) {
					$show = "show";
				}
			}
			if ($parent == 1) {
				$html .= '<ul class="vertical-nav-menu"> ';
			} else {
				if ($parent_id != 1) {
					if ($parent == $parent_id) {
						$html .= '<ul class="mm-show">';
					} else {
						$html .= '<ul>';
					}
				} else {
					$html .= '<ul>';
				}
			}
			// if (!isset($menu['parents'][$itemId])) {
			// 	if ($menu['items'][$itemId]['parent_id'] == 1) {
			// 		$html .= '<ul class="vertical-nav-menu"> ';
			// 	} else {
			// 		$html .= '<ul>';
			// 	}
			// } else {
			// 	if ($parent != 1) {
			// 		$html .= '<ul class="mm-show">';
			// 	} else {
			// 		$html .= '<ul>';
			// 	}
			// }
			foreach ($menu['parents'][$parent] as $itemId) {
				$id = $menu['items'][$itemId]['id'];
				$url = $menu['items'][$itemId]['url'];
				$urlText = $menu['items'][$itemId]['url-text'];
				$icon = $menu['items'][$itemId]['icon'];
				$name = $menu['items'][$itemId]['name'];
				if (!isset($menu['parents'][$itemId])) {
					if ($urlText != "#") {
						$active = ($path_active_name == strtolower($urlText)) ? 'class="mm-active"' : "";

						if ($menu['items'][$itemId]['parent_id'] == 1) {
							$html .= '<li ' . $active . '>
										<a href="' . $url . '">
												<i class="metismenu-icon pe-7s-' . $icon . '"></i>
												' . $name . '
										</a>
									</li>';
						} else {
							$html .= '<li ' . $active . '><a href="' . $url . '">
							<i class="metismenu-icon"></i>
										' . $name . '
									</a></li>';
						}
					}
				} else {

					if ($parent != 1) {
						$html .= '<div class="dropend">
									<a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false">
										' . $name . '
									</a>';
						$html .= $this->createTree($itemId, $menu, $parent_id, $path_active_name);
						$html .= "</div>";
					} else {
						if (!isset($menu['items'][$parent_id])) return;
						#parent yang ada child nya
						$grand_parent = $menu['items'][$parent_id]["parent_id"];
						$active = ($id == $parent_id || $id == $grand_parent) ? "mm-active" : '';
						$html .= '<li>
										<a href="#">
												<i class="metismenu-icon pe-7s-' . $icon . '"></i>
												' . $name . '
												<i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
										</a>';
						$html .= $this->createTree($itemId, $menu, $parent_id, $path_active_name);
						$html .= "</li>";
					}
				}
			}
			if ($parent == 1) {
				$html .= "</ul>";
			} else {
				if ($parent_id != 1) {
					$html .= '</ul>';
				} else {
					$html .= '</ul>';
				}
			}
		}
		return $html;
	}

	private function loadMenu()
	{
		$where = [];
		if ($this->data['is_superadmin']) {
			$menus = $this->menu_model->getMenuSuperadmin($where);
		} else {
			$where["role_id"] = $this->data['users_groups']->id;
			$menus = $this->menu_model->getMenuPrivileges($where);
		}
		if (empty($menus)) {
			return "";
		}

		$new_menus = array();
		if ($this->data['is_superadmin']) {
			foreach ($menus as $key => $value) {
				$new_menus[$value->id] = array();
				$new_menus[$value->id]['id'] = $value->id;
				$new_menus[$value->id]['name'] = $value->name;
				$new_menus[$value->id]['url'] = url('/') . '/' . $value->url;
				$new_menus[$value->id]['url-text'] = $value->url;
				$new_menus[$value->id]['parent_id'] = $value->parent_id;
				$new_menus[$value->id]['icon'] = $value->icon;
				$new_menus[$value->id]['description'] = $value->description;
				$new_menus[$value->id]['show_at'] = $value->show_at;
			}
		} else {
			foreach ($menus as $key => $value) {
				if ($value->function_id == 2) {

					$new_menus[$value->id] = array();
					$new_menus[$value->id]['id'] = $value->id;
					$new_menus[$value->id]['name'] = $value->name;
					$new_menus[$value->id]['url'] = url('/') . '/' . $value->url;
					$new_menus[$value->id]['url-text'] = $value->url;
					$new_menus[$value->id]['parent_id'] = $value->parent_id;
					$new_menus[$value->id]['icon'] = $value->icon;
					$new_menus[$value->id]['description'] = $value->description;
					$new_menus[$value->id]['show_at'] = $value->show_at;
				}
			}
		}

		$tree_menu = array(
			'items' => array(),
			'parents' => array(),
		);
		foreach ($new_menus as $a) {
			$tree_menu['items'][$a['id']] = $a;
			$tree_menu['parents'][$a['parent_id']][] = $a['id'];
		}
		$path_active_name = request()->segment(1);
		if (!empty(request()->segment(2))) {
			$data_uri_2 = [
				"create",
				"edit",
				"destroy",
				"detail",
				"export",
				"import",
				"download",
				"adjusment",
				"ttd",
				"approved",
				"proses_approval",
				"rejected",
				"insert",
				"update",
				"approval",
				"insert_progress",
				"progres",
				'edit_history',
				'profile',
				'milestone',
				'verifikasi',
				"process",
				"list",
				"program_per_aps"
			];
			if (!in_array(request()->segment(2), $data_uri_2)) {
				$path_active_name = request()->segment(1) . "/" . request()->segment(2);
			}
		}

		$data_parent = $this->menu_model->getParentIdBy(array("URL" => $path_active_name));
		$data_menu = $this->menu_model->getDetailMenuBy(array("URL" => $path_active_name));

		$parent_id = (!empty($data_parent)) ? $data_parent->parent_id : 0;
		if ($data_parent) {
			$parent = $this->menu_model->getParentIdBy(array("id" => $data_parent->parent_id));
		}

		$this->data['parent_page_name'] = (!empty($parent)) ? $parent->name : "";
		$this->data['page'] = (!empty($data_menu)) ? $data_menu->name : "";
		$this->data['page_description'] = (!empty($data_menu)) ? $data_menu->description : "";
		$this->data['page_id'] = (!empty($data_menu)) ? $data_menu->id : "";
		session(array("page_id" => $this->data['page_id']));
		return $this->createTree(1, $tree_menu, $parent_id, $path_active_name);
	}

	public function autoMigrate()
	{
		$this->load->library('migration');
		if ($this->migration->latest() === FALSE) {
			show_error($this->migration->error_string());
		}
	}

	private function cleanTmp()
	{
		if (is_dir("./uploaded/tmp")) {
			$files = glob("./uploaded/tmp/*");
			if (!empty($files)) {
				foreach ($files as $file) {
					if (is_file($file)) {
						$date_file = date("d-m-Y", filemtime($file));
						if ($date_file < date("d-m-Y")) {
							unlink($file);
						}
					}
				}
			}
		}
	}
	function isAuthenticated()
	{
		return Auth::check();
	}
}
