<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Job;
use App\Models\Candidate;

class Company extends Model
{
    protected $fillable = [
        'id', 'name', 'email', 'website', 
        'header_color', 'button_color', 'logo',
         'field', 'owner', 'default'
    ];
    use HasFactory;

    public function jobs():HasMany
    {
        return $this->hasMany(Job::class);
    }

    public function candidates():HasMany
    {
        return $this->hasMany(Candidate::class);
    }
}
