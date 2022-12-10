<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherDetails extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $id = 'id';

    protected $fillable = ['f_name', 'l_name', 'father_name', 'gander', 'email', 'password', 'address', 'DOB', 'mobile_number', 'category', 'photo'];
}
