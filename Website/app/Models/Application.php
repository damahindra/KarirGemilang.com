<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Application extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'job_id',
        'user_id',
        'application_date',
        'application_status',
        'resume_path'
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function job(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
