<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\concern;
use App\Models\schedule;
use App\Models\User;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::count();
        $concerns = concern::count();
        $schedules = schedule::count();
        $users = User::count();

        $concern_tables = concern::orderBy('concerns.created_at', 'DESC')->limit(10)->get();

        $customer_tables = Customer::orderBy('customers.created_at', 'DESC')->limit(10)->orderBy('created_at')->get();

        $user_schedules = schedule::orderBy('schedules.created_at', 'DESC')
                                ->whereUserId(auth()->id())
                                ->joinConcern()
                                ->limit(10)
                                ->get();

        return Inertia::render('Dashboard', [
            'customers' => $customers,
            'concerns' => $concerns,
            'schedules' => $schedules,
            'users' => $users,
            'concern_tables' => $concern_tables,
            'customer_tables' => $customer_tables,
            'user_schedules' => $user_schedules,

        ]);
    }

}
