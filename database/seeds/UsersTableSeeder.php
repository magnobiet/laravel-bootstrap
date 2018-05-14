<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $now = date('Y-m-d H:i:s');

        DB::table('users')->insert([
            [
                'name'           => 'Root',
                'email'          => 'root@root',
                'password'       => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => '🔑🔒',
                'created_at'     => $now,
                'updated_at'     => $now,
            ],
        ]);

        if (App::environment(['local'])) {
            factory(\App\Entities\User::class, 100)->create();
        }

    }

}
