<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'id',
        'day',
        'candidate_id',
        'time',
    ];
    use HasFactory;
}
