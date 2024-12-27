<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskHistory extends Model
{
    protected $fillable = ['status', 'description'];

    // Definisikan relasi polymorphic
    public function historable()
    {
        return $this->morphTo();
    }
}
