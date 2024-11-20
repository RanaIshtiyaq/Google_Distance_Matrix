<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Distance;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CalculateDistances implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $companies;
    public $users;

    public function __construct($companies, $users)
    {
        $this->companies = $companies;
        $this->users = $users;
    }

    public function handle()
    {
        $apiKey = env('OPENROUTESERVICE_API_KEY');

        foreach ($this->companies as $company) {
            foreach ($this->users as $user) {
                try {
                    // Prepare the OpenRouteService API request URL
                    $response = Http::withHeaders([
                        'Authorization' => $apiKey,
                    ])->get('https://api.openrouteservice.org/v2/directions/driving-car', [
                        'start' => "{$company->longitude},{$company->latitude}",
                        'end' => "{$user->longitude},{$user->latitude}",
                    ]);

                    // Check if the API request is successful
                    if ($response->successful()) {
                        $data = $response->json();
                        
                        // Extract the distance (in meters) and travel time (in seconds)
                        $distance = $data['features'][0]['properties']['segments'][0]['distance'] / 1000; // Convert to km
                        $travelTime = $data['features'][0]['properties']['segments'][0]['duration'] / 60; // Convert to minutes

                        // Save the calculated data into the Distances table
                        Distance::updateOrCreate(
                            ['company_id' => $company->id, 'user_id' => $user->id],
                            ['distance' => $distance, 'travel_time' => $travelTime]
                        );
                    } else {
                        Log::error("API error: " . $response->body());
                    }
                } catch (\Exception $e) {
                    Log::error("Error calculating distance: {$e->getMessage()}");
                }
            }
        }
    }
}
