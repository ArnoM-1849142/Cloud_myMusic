<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class SoundSettings extends Model
{
    use HasFactory;

    protected $fillable = [
        'volume', 'treble', 'mid', 'bass'
    ];
}
