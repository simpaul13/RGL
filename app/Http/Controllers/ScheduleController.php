<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorescheduleRequest;
use App\Http\Requests\UpdatescheduleRequest;
use App\Models\schedule;
use Inertia\Inertia;
use Inertia\Response;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $schedules = schedule::whereUserId(auth()->id())
                        ->joinConcern()
                        ->orderBy('schedules.created_at', 'DESC')
                        ->get();

        return Inertia::render('Schedule/index', [
            'schedules' => $schedules,
        ]);
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
    public function store(StorescheduleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatescheduleRequest $request, schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(schedule $schedule)
    {
        //
    }
}
