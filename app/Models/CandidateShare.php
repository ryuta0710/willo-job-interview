<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateShare extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'candidate_id',
        'q_no',
        'allow',
    ];
}
