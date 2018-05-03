<?php

use Illuminate\Database\Migrations\Migration;

class AlterUsersTableAddPhotoUrlColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('users', function ($table) {
            $table->string('photo_url')->after('password')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('users', function ($table) {
            $table->dropColumn('photo_url');
        });

    }
}
