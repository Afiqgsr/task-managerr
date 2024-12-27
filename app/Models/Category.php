<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Tambahkan SoftDeletes

class Category extends Model
{
    use HasFactory, SoftDeletes; // Gunakan trait SoftDeletes

    /**
     * Kolom-kolom yang dapat diisi secara massal.
     */
    protected $fillable = ['name', 'slug', 'description'];

    /**
     * Cast 'deleted_at' menjadi objek Carbon untuk soft deletes.
     */

    protected $dates = [
        'deleted_at',
    ]; 

    /**
     * Relasi dengan model Task.
     * Satu kategori dapat memiliki banyak tugas.
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
