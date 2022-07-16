<?php

namespace App\Models;

use App\User;
use Eloquent;

class Subject extends Eloquent
{
    protected $fillable = ['name', 'my_class_id', 'teacher_id', 'slug','time','days', 'school_id'];

    public function my_class()
    {
        return $this->belongsTo(MyClass::class,'my_class_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class);
    }
}
