<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_details', function (Blueprint $table) {
            $table->id();
            $table->string('f_name', 50);
            $table->string('l_name', 50);
            $table->string('father_name', 50);
            $table->string('gander', 10)->nullable();
            $table->string('email', 100);
            $table->string('password', 100);
            $table->text('address');
            $table->string('DOB', 15);
            $table->string('mobile_number', 15);
            $table->string('category', 15)->nullable();
            $table->string('photo', 255);
            $table->dateTime('date')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teacher_details');
    }
};
