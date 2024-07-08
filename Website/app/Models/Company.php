<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;
    protected $primaryKey = 'company_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_name',
        'company_city',
        'company_country',
        'company_benefits',
        'company_industry',
        'company_description'
    ];

    public function employer(): HasMany {
        return $this->hasMany(Employer::class);
    }
}
