<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\concern;
use App\Models\schedule;
use Carbon\Carbon;

class CompletedConcernController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $concern = concern::findOrFail($id);

        $schedule = schedule::findOrFail($concern->schedule_id);


        $schedule->update([
            'status' => 'Completed',
            'modified_by' => auth()->id() 
        ]);

        $concern->update([
            'schedule_id' => $schedule->schedules_id,
            'modified_by' => auth()->id(),
        ]);

        return [
            'data' => $concern,
            'success' => 1
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
