<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MockRegistration extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'mock_time_id',
        'user_id',
    ];
}
