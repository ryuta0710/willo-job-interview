<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'id',
        'job_id',
        'candidate_id',
        'content',
        'rc_url',
        'question_type',
        'question_id',
        'url',
        'question_content',
        'count',
        'question_retake',
        'retake',
        'thinking_minute',
    ];
    use HasFactory;
}
