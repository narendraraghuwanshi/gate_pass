<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table) {
            $table->integer('mobile')->default(0);
            $table->string('firstName')->nullable();
            $table->string('lastName')->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->tinyInteger('stateId')->default;
            $table->tinyInteger('pinCode')->default;
            $table->tinyInteger('DocumentType')->default;
            $table->string('documentNumber')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
            $table->dropColumn('paid');
        });
    }
}
