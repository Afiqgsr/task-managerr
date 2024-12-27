<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Include SoftDeletes
use Illuminate\Support\Carbon;
use App\Models\TaskHistory;

class Task extends Model
{
    use HasFactory, SoftDeletes; // Use the SoftDeletes trait

    protected $hidden = [
        "updated_at",
        "created_at",
    ];

    // Specify the fillable attributes (mass assignable)
    protected $fillable = [
        'title',
        'description',
        'status',
        'due_date',
        'user_id',
        'category_id',
    ];

    // Cast 'due_date' and 'deleted_at' to Carbon instances
    protected $dates = [
        'due_date',
        'deleted_at',
    ]; // Include deleted_at for soft deletes

    // Define a relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define a relationship with the Category model
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Define a polymorphic relationship with the TaskHistory model
    public function histories()
    {
        return $this->morphMany(TaskHistory::class, 'historable');
    }

    // Method to change the task status and log the history
    public function changeStatus($newStatus, $description = null)
    {
        // Check if the status has changed
        if ($this->status !== $newStatus) {
            // Save the status change history to task_histories
            $this->histories()->create([
                'status' => $newStatus,
                'description' => $description,
            ]);

            // Update the task status
            $this->status = $newStatus;
            $this->save();
        }
    }

    // Scope to filter tasks by status
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
