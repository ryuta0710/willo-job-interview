<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Job;

class Candidate extends Model
{
    protected $fillable = [
        'id',
        'job_id',
        'job_url',
        'shared_url',
        'status',
        'tel',
        'email',
        'country',
        'review',
        'start_at',
        'response_at',
        'is_email_send',
        'note',
        'url',
        'retake',
        'name',
        'rate',
        'user_id',
        'time',
    ];
    use HasFactory;
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner');
    }
    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
