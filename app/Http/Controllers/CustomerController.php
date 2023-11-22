<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorecustomerRequest;
use App\Http\Requests\UpdatecustomerRequest;
use App\Models\Customer;
use App\Models\concern;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::get();



        return Inertia::render('Customer/index', [
            'customers' => $customers,
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
       $customer = Customer::create([
            'customer_firstname' => encrypt(strtolower($request->customer_firstname)),
            'customer_lastname' => encrypt(strtolower($request->customer_lastname)),
            'customer_middlename' => encrypt(strtolower($request->customer_middlename)),
            'customer_gender' => $request->customer_gender,
            'email' => encrypt(strtolower($request->email)),
            'company' => encrypt(strtolower($request->company)),
            'contact_number' => encrypt(strtolower($request->contact_number)),
            'country' => encrypt(strtolower($request->country)),
            'province' => encrypt(strtolower($request->province)),
            'city' => encrypt(strtolower($request->city)),
            'barangay' => encrypt(strtolower($request->barangay)),
            'zipcode' => $request->zipcode,
            'additional_information' => encrypt(strtolower($request->additional_information)),
            'created_by' => auth()->id(),
            'modified_by' => auth()->id()
        ]);
    
        return [
            'success' => 1,
            'data' => $customer
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(customer $customer)
    {
        $customer = Customer::findOrFail($customer->customer_id);

        $conerns = concern::whereCustomerId($customer->customer_id)->joinShedule()->get();

        return Inertia::render('Customer/show', [
            'customer' => $customer,
            'concerns' => $conerns
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecustomerRequest $request, customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(customer $customer)
    {
        $customer->delete();

        return ['success' => 1];
    }
}
