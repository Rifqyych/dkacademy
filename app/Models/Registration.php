<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'program',
        'level',
        'message',
        'tanggal_daftar',
        'status'
    ];
}