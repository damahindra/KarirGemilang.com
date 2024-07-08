<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Job extends Model
{
    use HasFactory;
    // Set the primary key
    protected $primaryKey = 'job_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'employer_id',
        'job_title',
        'apply_before',
        'exp_level',
        'job_description',
        'location_type',
        'job_location',
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
