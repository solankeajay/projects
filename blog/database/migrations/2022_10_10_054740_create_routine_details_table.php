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
        Schema::create('routine_details', function (Blueprint $table) {
            $table->integer('id',11);
            $table->unsignedBigInteger('class_id');
            $table->string('day_title',50);
            $table->string('subject',100);
            $table->string('subject_teacher',100);
            $table->string('start_time',15);
            $table->string('end_time',15);
            $table->string('classroom_number',10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('routine_details');
    }
};
