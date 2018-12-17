<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $table = 'permissions';
        $routes = [
            'users',
            'roles',
            'permissions',
            'states',
            'cities',
        ];
        $actions = [
            'index',
            'create',
            'store',
            'show',
            'edit',
            'update',
            'destroy',
        ];
        $now = date('Y-m-d H:i:s');
        $data = [];

        foreach ($routes as $route) {

            foreach ($actions as $action) {

                $data[] = [
                    'name'        => $route . '.' . $action,
                    'description' => ucwords($action) . ' ' . $route,
                    'created_at'  => $now,
                ];

            }

        }

        if (env('APP_ENV') === 'local') {
            DB::table($table)->truncate();
        }

        DB::table($table)->insert($data);

    }

}
