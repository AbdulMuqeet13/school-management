<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'motto',
        'address',
        'state_license_num',
        'tax_id',
        'phone',
        'email',
        'section',
        'logo',
        'category',
    ];
}
