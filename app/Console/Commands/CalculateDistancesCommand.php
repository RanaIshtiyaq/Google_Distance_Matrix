<?php

namespace App\Console\Commands;

use App\Jobs\CalculateDistances;
use App\Models\Company;
use App\User;
use Illuminate\Console\Command;

class CalculateDistancesCommand extends Command
{
    protected $signature = 'calculate:distances';
    protected $description = 'Calculate distances between companies and users using OpenRouteService';

    public function handle()
    {
        $companies = Company::all();
        $users = User::all();

        // Dispatch the job
        CalculateDistances::dispatch($companies, $users);

        $this->info('Distance calculation job dispatched!');
    }
}
