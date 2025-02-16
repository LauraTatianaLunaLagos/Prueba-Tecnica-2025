<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('identification')->unique();
            $table->string('address');
            $table->string('phone');
            $table->string('country');
            $table->string('city');
            $table->unsignedBigInteger('boss_id')->nullable(); // Jefe inmediato
            $table->foreign('boss_id')->references('id')->on('employees')->onDelete('set null');
            $table->softDeletes(); // Para eliminación lógica
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
