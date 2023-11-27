<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreconcernRequest;
use App\Http\Requests\UpdateconcernRequest;
use App\Models\concern;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;

class ConcernController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $concerns = concern::joinShedule()->orderBy('concerns.created_at', 'DESC')->get();

        return Inertia::render('Concern/index', [
            'concerns' => $concerns,
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
    public function store(Request $request)
    {
        $concern = concern::create([
            'type' => $request->type,
            'type_aircon' => $request->type_aircon,
            'horset_power' => $request->horset_power,
            'schedule_id' => $request->schedule_id,
            'user_id' => $request->user_id,
            'customer_id' => $request->customer_id,
            'created_by' => auth()->id(),
            'modified_by' => auth()->id()
        ]);

        return [
            'success' => 1,
            'data' => $concern
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(concern $concern)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(concern $concern)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateconcernRequest $request, concern $concern)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(concern $concern)
    {
        $concern->delete();

        return ['success' => 1];
    }
}
