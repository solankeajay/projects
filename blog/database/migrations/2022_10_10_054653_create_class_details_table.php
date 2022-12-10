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
        Schema::create('class_details', function (Blueprint $table) {
            $table->integer('id',11);
            $table->string('class_title',55);
            $table->string('class_code',55);
            $table->string('total_student',55);
            $table->string('daily_attendance',3);
            $table->string('yearly_attendance',3);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_details');
    }
};
