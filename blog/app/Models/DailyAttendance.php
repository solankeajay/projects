<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyAttendance extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'daily_attendances';

    protected $id = 'id';

    protected $fillable = ['date','student_id','teacher_id','class_title','student_name','role_no','present_or_absent','class_amount_monthly','class_amount_yearly','attend_amount_monthly','attend_amount_yearly','percentise_month','percentise_year'];
}
