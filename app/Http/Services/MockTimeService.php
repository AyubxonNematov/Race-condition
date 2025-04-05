<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\DB;
use App\Http\Repositories\MockTimeRepository;

class MockTimeService
{
    public function __construct(private MockTimeRepository $mockTimeRepository)
    {
    }

    public function paginationModel()
    {
        return $this->mockTimeRepository->pagination();
    }

    public function registerUser(int $mockTimeId, int $userId)
    {
        try {
            // Start transaction
            DB::beginTransaction();
    
            // Apply row-level lock
            $mockTime = $this->mockTimeRepository->lockForUpdate($mockTimeId);
    
            // Count registered users
            $registeredCount = $this->mockTimeRepository->countRegisteredUsers($mockTimeId);
    
            if ($registeredCount >= $mockTime->capacity) {
                // Rollback because capacity is full
                DB::rollBack();
                abort(409, 'This mock time is already full.');
            }

            //check if user is already registered
            if ($this->mockTimeRepository->isAlreadyRegistered($mockTimeId, $userId)) {
                abort(409, 'You are already registered for this mock time.');
            }
    
            // Register user to mock time
            $mockTime = $this->mockTimeRepository->registerUser($mockTimeId, $userId);
    
            DB::commit();
            return $mockTime;
    
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
} 