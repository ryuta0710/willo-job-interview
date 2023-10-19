<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'candidate_id',
        'name',
        'content',
        'type',
    ];
    use HasFactory;
}
