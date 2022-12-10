<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectDetails extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $id = 'id';

    protected $fillable = ['subject_name','year', 'class_id', 'subject_teacher'];
}
