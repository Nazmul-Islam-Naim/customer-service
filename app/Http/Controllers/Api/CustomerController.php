<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest\CreateRequest;
use App\Http\Requests\CustomerRequest\UpdateRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        // Gate::authorize('app.customer.store');
        try {
            Customer::create($request->all());
            return response()->json(['success'=>'Customer saved successfully.']);
        } catch (\Exception $exception) {
            return response()->json(['error'=>'Somthing went wrong!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        // Gate::authorize('app.customer.store');
        try {
            Customer::where('id',$id)->update($request->all());
            return response()->json(['success'=>'Customer update successfully.']);
        } catch (\Exception $exception) {
            return response()->json(['error'=>'Somthing went wrong!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
