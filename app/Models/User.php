<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class User extends Model
{
    use HasFactory;
    protected $fillable = [
        'last_active_at'
    ];
    protected $casts = [
        'last_active_at' => 'datetime',
     ];
}
