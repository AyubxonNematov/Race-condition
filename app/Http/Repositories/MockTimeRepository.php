<?php

namespace App\Http\Repositories;

use App\Models\MockTime;
use App\Enums\PaginationEnum;

class MockTimeRepository
{
    public function __construct(private MockTime $model)
    {
    }

    public function query()
    {
        return $this->model->query();
    }

    public function pagination()
    {
        return $this->query()
                ->with('mock')
                ->paginate(PaginationEnum::PER_PAGE->value);
    }

    public function findById(int $id)
    {
        return $this->query()
                ->findOrFail($id);
    }

    public function lockForUpdate($id)
    {
        return $this->query()->where('id', $id)
            ->lockForUpdate()
            ->first();
    }
    
    public function countRegisteredUsers(int $mockTimeId): int
    {
        return $this->findById($mockTimeId)
            ->registrations()
            ->count();
    }

    public function isAlreadyRegistered(int $mockTimeId, int $userId): bool
    {
        return $this->findById($mockTimeId)
            ->registrations()
            ->where('user_id', $userId)
            ->exists();
    }

    public function registerUser(int $mockTimeId, int $userId)
    {
        $model = $this->findById($mockTimeId);
        $model->registrations()->create([
            'user_id' => $userId,
        ]);
        return $model;
    }
}