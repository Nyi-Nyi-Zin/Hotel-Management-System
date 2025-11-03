<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_number',
        'floor',
        'type',
        'capacity',
        'price',
        'facilities',
        'description',
    ];

    protected $casts = [
        'facilities' => 'array',
    ];
}
