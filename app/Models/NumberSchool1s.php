<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NumberSchool1s extends Model
{
    use HasFactory;

    protected $fillable = [
        'schoolname',
        'hex_address',
        'content',
        'file',
        'created_ats',
    ];
}
