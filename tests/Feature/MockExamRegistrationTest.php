<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\MockTime;
use App\Models\MockRegistration;
use Illuminate\Support\Facades\ParallelTesting;
use GuzzleHttp\Promise;
use GuzzleHttp\Client;

class MockExamRegistrationTest extends TestCase
{

    public function actingAs($user, $guard = null)
    {
        return parent::actingAs($user, $guard);
    }

    public function test_user_can_register_for_mock_exam()
    {
        $mockTime = MockTime::factory()->create();
        $user = User::factory()->createOne(['id' => ParallelTesting::token()]);
        
        $response = $this->actingAs($user)
            ->postJson("/api/mock-time/{$mockTime->id}/register");

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'mock_name',
                    'start_time',
                    'end_time',
                    'created_at'
                ]
            ]);
    }
    
    public function test_register_user_with_race_condition()
    {
        $baseUrl = env('APP_URL', 'http://localhost:8000');

        $capacity = 3;
        
        $mockTime = MockTime::factory()->create(['capacity' => $capacity]);
        
        $users = User::factory()->count($capacity)->create();
        
        $tokens = [];
        foreach ($users as $user) {
            $tokens[] = $user->createToken('test-token')->plainTextToken;
        }
        
        $client = new Client([
            'base_uri' => $baseUrl,
            'timeout' => 10,
            'http_errors' => false,
        ]);
        
        $promises = [];
        foreach ($tokens as $token) {
            $promises[] = $client->postAsync("/api/mock-time/{$mockTime->id}/register", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
            ]);
        }
    
        Promise\Utils::settle($promises)->wait();
        
        $registrationCount = MockRegistration::where('mock_time_id', $mockTime->id)->count();

        $this->assertLessThanOrEqual($capacity, $registrationCount, 'Race condition detected: registrations exceeded capacity');
    }
} 