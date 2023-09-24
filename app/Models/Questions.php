<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $fillable = [
        'id',
        'type',
        'retake',
        'content',
        'answer_time',
        'limit_type',
        'max',
        'thinking_hour',
        'thinking_minute',
        'question_no',
        'job_id',
        'user_id',
    ];
    use HasFactory;
}
