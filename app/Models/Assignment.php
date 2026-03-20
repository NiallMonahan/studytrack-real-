<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = ['module_id', 'title', 'description', 'due_at'];

    public $timestamps = false;

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
