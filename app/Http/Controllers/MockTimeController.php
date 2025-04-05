<?php

namespace App\Http\Controllers;

use App\Models\MockTime;
use App\Http\Services\MockTimeService;
use App\Http\Resources\MockTimeResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MockTimeController
{
    public function __construct(private MockTimeService $mockTimeService)
    {
    }

    public function index(): AnonymousResourceCollection
    {
        return MockTimeResource::collection($this->mockTimeService->paginationModel());
    }
    
    public function registerUser(MockTime $mockTime): MockTimeResource
    {
        return new MockTimeResource(    
            $this->mockTimeService->registerUser($mockTime->id, auth()->user()->id)
        );
    }
}
