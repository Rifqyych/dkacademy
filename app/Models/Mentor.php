<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    protected $fillable = [
        'nama_mentor',
        'spesialisasi',
        'deskripsi',
        'foto',
    ];
}
