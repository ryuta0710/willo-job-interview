<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Candidate;

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
        'field_id',
        'started_count'
    ];
    use HasFactory;
    public function candidates(): HasMany
    {
        return $this->hasMany(Candidate::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
