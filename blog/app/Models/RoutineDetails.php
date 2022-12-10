<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoutineDetails extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $id = 'id';

    protected $fillable = ['class_id','day_title','subject', 'subject_teacher', 'start_time', 'end_time', 'classroom_number'];
}
