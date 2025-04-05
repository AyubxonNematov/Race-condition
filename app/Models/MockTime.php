<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MockTime extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'mock_id',
        'start_time',
        'end_time',
        'capacity',
    ];
    
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];
    
    public function mock(): BelongsTo
    {
        return $this->belongsTo(Mock::class, 'mock_id');
    }
    
    public function registrations(): HasMany
    {
        return $this->hasMany(MockRegistration::class);
    }
}
