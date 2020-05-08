<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPhotoToPrintColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fire_identifications', function (Blueprint $table) {
            DB::statement("ALTER TABLE fire_identifications ADD photo_to_print LONGBLOB");  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fire_identifications', function (Blueprint $table) {
            //
        });
    }
}
