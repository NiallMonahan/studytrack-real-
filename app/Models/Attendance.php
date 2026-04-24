<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'module_id',
        'student_name',
        'date',
        'status',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}