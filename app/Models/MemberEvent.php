<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'event_id',
    ];
}
