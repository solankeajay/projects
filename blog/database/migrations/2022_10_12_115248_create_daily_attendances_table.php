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
        Schema::create('daily_attendances', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('student_id');
            $table->string('teacher_id');
            $table->string('class_title');
            $table->string('student_name');
            $table->string('role_no',10);
            $table->string('present_or_absent',1);
            $table->string('class_amount_monthly',10);
            $table->string('class_amount_yearly',10);
            $table->string('attend_amount_monthly',10);
            $table->string('attend_amount_yearly',10);
            $table->string('percentise_month',10);
            $table->string('percentise_year',10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daily_attendances');
    }
};
