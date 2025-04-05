<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MockTimeResource extends JsonResource
{   
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'mock_name' => $this->mock->title,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
} 