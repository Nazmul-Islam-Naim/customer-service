<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest\CreateRequest;
use App\Http\Requests\CustomerRequest\UpdateRequest;
use App\Http\Resources\CustomerResource\CustomerResource;
use App\Models\Customer;
use App\Models\RegistrationTargetCurrent;
use App\Models\RegistrationTargetMonthly;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;

class CustomerController extends Controller
{
    use ApiResponses;
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
        
        $data = $request->all();
        $data['division_id'] = auth()->user()->division_id;
        $data['district_id'] = auth()->user()->district_id;
        $data['user_id'] = auth()->user()->id;
        $data['date'] = date('Y-m-d');

        if(Arr::has($data, 'avatar')){
            $data['avatar'] = (Arr::pull($data, 'avatar'));
            Image::make($data['avatar'])->resize(600,600);
            $data['avatar'] = (Arr::pull($data, 'avatar'))->store('customer-avatar');
        }

        try {
            DB::beginTransaction();
            $customer = Customer::create($data);
            $customer->products()->attach($request->product_id);
            RegistrationTargetCurrent::where('user_id',auth()->user()->id)->increment('recovery',1);
            RegistrationTargetMonthly::where('user_id',auth()->user()->id)
                                    ->where('month',date('F'))    
                                    ->where('year',date('Y'))    
                                    ->increment('recovery',1);
            DB::commit();
            return $this->respond($customer);
        } catch (\Exception $exception) {
            return $this->exceptionRespond($exception);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $customer = Customer::findOrFail($id);
            return $this->respond(new CustomerResource($customer));
        } catch (\Exception $exception) {
            return $this->exceptionRespond($exception);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        // Gate::authorize('app.customer.store');
        
        $customer = Customer::findOrFail($id);
        
        $data = $request->all();
        $data['division_id'] = auth()->user()->division_id;
        $data['district_id'] = auth()->user()->district_id;
        $data['user_id'] = auth()->user()->id;

        if(Arr::has($data, 'avatar')){
            $data['avatar'] = (Arr::pull($data, 'avatar'));
            Image::make($data['avatar'])->resize(600,600);
            $data['avatar'] = (Arr::pull($data, 'avatar'))->store('customer-avatar');
        }

        try {
            DB::beginTransaction();
            $customer->update($data);
            $customer->products()->sync($request->product_id);
            DB::commit();
            return response()->json(['success'=>'Customer update successfully.', 'data' => $customer]);
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
