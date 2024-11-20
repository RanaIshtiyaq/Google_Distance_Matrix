<?php

namespace Tests\Unit;

use App\Jobs\CalculateDistances;
use App\Models\Company;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CalculateDistancesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_calculate_distances_job()
    {
        // Seed test data
        $company = Company::factory()->create();
        $user = User::factory()->create();

        // Dispatch the job
        $job = new CalculateDistances([$company], [$user]);
        $job->handle();

        // Check that the distance and travel time were saved
        $this->assertDatabaseHas('distances', [
            'company_id' => $company->id,
            'user_id' => $user->id,
        ]);
    }
}
