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

        DB::table('roles')->insert([
            [
                'id'          => 1,
                'name'        => 'root',
                'description' => 'Superuser',
            ],
            [
                'id'          => 2,
                'name'        => 'administrator',
                'description' => 'System administrator',
            ],
            [
                'id'          => 3,
                'name'        => 'user',
                'description' => 'System user',
            ],
        ]);

    }

}
