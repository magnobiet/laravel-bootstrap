<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $table = 'roles';
        $now = date('Y-m-d H:i:s');

        if (env('APP_ENV') === 'local') {
            DB::table($table)->truncate();
        }

        DB::table($table)->insert([
            [
                'id'          => 1,
                'name'        => 'Root',
                'description' => 'Superuser',
                'created_at'  => $now,
            ],
            [
                'id'          => 2,
                'name'        => 'Administrator',
                'description' => 'System administrator',
                'created_at'  => $now,
            ]
            ,
            [
                'id'          => 3,
                'name'        => 'User',
                'description' => 'System user',
                'created_at'  => $now,
            ],
        ]);

    }

}
