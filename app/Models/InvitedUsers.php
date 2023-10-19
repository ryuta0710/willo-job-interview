<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvitedUsers extends Model
{
    protected $fillable = [
        'id', 'user_id', 'email', 'inviter', 'role', 'status'
    ];
    use HasFactory;
}
