<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simple extends Model
{
    use HasFactory;

    protected $table = "simples";

    public $timestamps = false;

    protected $fillable = ['name','email','phone_no','gander'];
}
