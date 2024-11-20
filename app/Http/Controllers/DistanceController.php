<?php

namespace App\Http\Controllers;

use App\Jobs\CalculateDistances;
use App\Models\Company;
use App\Models\Distance;
use App\User;
use Illuminate\Http\Request;

class DistanceController extends Controller
{
    public function calculateDistances()
    {
        // Retrieve all companies and users from the database
        $companies = Company::all();
        $users = User::all();

        // Dispatch the job to calculate distances asynchronously
        CalculateDistances::dispatch($companies, $users);
        
         // Chunk the companies into smaller groups of 50
        // $companies->chunk(50, function ($chunkedCompanies) use ($users) {
        //     // Dispatch the job for each chunk of companies
        //     CalculateDistances::dispatch($chunkedCompanies, $users);
        // });

        // Return a response to the client
        return response()->json(['message' => 'Distance calculation job dispatched!']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Distance  $distance
     * @return \Illuminate\Http\Response
     */
    public function show(Distance $distance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Distance  $distance
     * @return \Illuminate\Http\Response
     */
    public function edit(Distance $distance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Distance  $distance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Distance $distance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Distance  $distance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Distance $distance)
    {
        //
    }
}
