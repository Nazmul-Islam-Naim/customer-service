<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest\CreateRequest;
use App\Http\Requests\CustomerRequest\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Customer;
use Validator;
use Response;
use Session;
use Auth;
use Str;
use DB;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Gate::authorize('app.dvision.index'); 
        if ($request->ajax()) {
            $alldata= Customer::with(['businessCategory','area','area.district', 'area.district.division', 'user'])
                ->get();
            return DataTables::of($alldata)
                ->addIndexColumn()->make(True);
            }
        return view('customer.customer-list');
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
    public function store(CreateRequest $request)
    {
        // Gate::authorize('app.Customers.create');

        DB::beginTransaction();
        try{
            Customer::create($request->all());
            DB::commit();
            Session::flash('flash_message','Customer Successfully Added !');
            return redirect()->back()->with('status_color','success');
        }catch(\Exception $e){
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Gate::authorize('app.Customers.edit');
        $data['single_data']= Customer::find($id);
        $data['alldata']= Customer::all();
        return view('customer.customer', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        // Gate::authorize('app.Customers.edit');
        $data=Customer::findOrFail($id);
        try{
            $data->update($request->all());
            Session::flash('flash_message','Customer Successfully Updated !');
            return redirect()->back()->with('status_color','warning');
        }catch(\Exception $e){
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Gate::authorize('app.Customers.destroy');
        try {
            $data = Customer::findOrFail($id);
            $data->delete();
            Session::flash('flash_message','Customer Successfully Deleted !');
            return redirect()->back()->with('status_color','danger');
        } catch (\Exception $exception) {
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }
}

