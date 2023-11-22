<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\concern;
use App\Models\schedule;
use Carbon\Carbon;

class DeclinedConcernController extends Controller
{
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, )
    {
        $concern = concern::findOrFail($id);

        if(!$concern->schedules_id) {
            $schedule = schedule::where('schedules_id', $concern->schedule_id);
            $schedule->delete();
        }
        
        $concern->update([
            'user_id' => null,
            'schedule_id' => null
        ]);

        return [
            'data' => $concern,
            'success' => 1
        ];
    }
}
