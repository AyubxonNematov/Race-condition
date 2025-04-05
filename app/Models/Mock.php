<?php

namespace App\Models;

use App\Models\MockTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mock extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
    ];

    public function mockTimes(): HasMany
    {
        return $this->hasMany(MockTime::class);
    }
}
