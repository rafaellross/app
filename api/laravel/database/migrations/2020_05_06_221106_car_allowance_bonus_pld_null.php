<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CarAllowanceBonusPldNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
          $table->float('car_allowance', 8, 2)->nullable()->change();
          $table->float('bonus', 8, 2)->nullable()->change();
          $table->float('pld', 8, 2)->nullable()->change();
          $table->float('rdo_bal', 8, 2)->nullable()->change();
          $table->float('anl', 8, 2)->nullable()->change();            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            //
        });
    }
}
