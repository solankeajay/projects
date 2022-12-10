<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassDetails extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $id = 'id';

    protected $fillable = ['class_title', 'class_code', 'total_student', 'daily_attendance', 'yearly_attendance'];
}
