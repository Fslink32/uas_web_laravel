<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $this->insert_menu();
        $this->insert_function();
        $this->insert_menu_function();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    function insert_menu()
    {
        $table = 'menu';
        DB::table($table)->truncate();
        $datas = array(
            ['id' => 1, 'module_id' => 1, 'name' => 'root', 'url' => '#', 'parent_id' => 0, 'icon' => "", 'sequence' => 0, 'description' => 'Root Aplikasi', "show_at" => 0],
            ['id' => 2, 'module_id' => 1, 'name' => 'Dashboard', 'url' => 'admin/dashboard', 'parent_id' => 1, 'icon' => "home", 'sequence' => 1, 'description' => 'Dashboard', "show_at" => 0],

            ['id' => 3, 'module_id' => 1, 'name' => 'Akses Sistem', 'url' => '#', 'parent_id' => 1, 'icon' => "key", 'sequence' => 2, 'description' => 'Akses Sistem', "show_at" => 0],
            ['id' => 4, 'module_id' => 1, 'name' => 'Jabatan', 'url' => 'admin/role', 'parent_id' => 3, 'icon' => "", 'sequence' => 2, 'description' => 'Jabatan', "show_at" => 0],
            ['id' => 5, 'module_id' => 1, 'name' => 'Pengguna', 'url' => 'admin/user', 'parent_id' => 3, 'icon' => "", 'sequence' => 3, 'description' => 'Pengguna', "show_at" => 0],

            ['id' => 6, 'module_id' => 1, 'name' => 'Pedagang', 'url' => 'admin/pedagang', 'parent_id' => 1, 'icon' => "user", 'sequence' => 3, 'description' => 'Pedagang', "show_at" => 0],
            ['id' => 7, 'module_id' => 1, 'name' => 'Harga', 'url' => 'admin/harga', 'parent_id' => 1, 'icon' => "cash", 'sequence' => 3, 'description' => 'Harga', "show_at" => 0],
        );
        DB::table($table)->insert($datas);
    }

    function insert_function()
    {
        $table = 'function';
        DB::table($table)->truncate();

        $data = array(
            array('name' => 'Create', 'description' => 'Can Create'),
            array('name' => 'Read', 'description' => 'Can Read'),
            array('name' => 'Update', 'description' => 'Can Update'),
            array('name' => 'Delete', 'description' => 'Can Delete'),
            array('name' => 'Active', 'description' => 'Can Active'),
            array('name' => 'Access', 'description' => 'Can Access'),
        );
        DB::table($table)->insert($data);
    }

    function insert_menu_function()
    {
        $table = 'menu_function';
        DB::table($table)->truncate();

        $menus = [
            "1" => [2],

            //parent menu
            "2" => [2],
            "3" => [2],

            //Akses Sistem
            "4" => [1, 2, 3, 4, 5],
            "5" => [1, 2, 3, 4, 5, 6],

            "6" => [1, 2, 3, 4, 5],
            "7" => [1, 2, 3, 4, 5],

        ];

        $data = [];
        foreach ($menus as $key => $value) {
            for ($i = 0; $i < count($value); $i++) {
                $data[] = [
                    "menu_id" => $key,
                    "function_id" => $value[$i],
                ];
            }
        }

        DB::table($table)->insert($data);
    }
}
