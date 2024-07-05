<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Job extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'job_title',
        'apply_before',
        'exp_level',
        'job_description',
        'location_type',
        'location',
        'prerequisites',
        'total_applicants'
    ];

    public function application(): HasMany {
        return $this->hasMany(Application::class);
    }

    public function employer(): BelongsTo {
        return $this->belongsTo(Employer::class);
    }
}
