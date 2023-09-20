<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'id', 'name', 'address', 'website', 
        'header_color', 'button_color', 'logo',
         'field', 'owner', 'default'
    ];
    use HasFactory;
}
