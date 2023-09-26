<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'id',
        'title',
        'salary',
        'company_id',
        'video_url',
        'video_rc_url',
        'description',
        'record',
        'user_id',
        'mail_invite_id',
        'mail_success_id',
        'mail_reminder_id',
        'sms_invite_id',
        'sms_reminder_id',
        'limit_date',
        'redirect_url',
        'language',
        'isTip',
        'url',
        'responses_count',
        'status',
        'field_id'
    ];
    use HasFactory;
}
