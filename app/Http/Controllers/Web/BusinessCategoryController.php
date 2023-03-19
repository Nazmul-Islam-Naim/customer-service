<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusinessCategoryRequest\CreateRequest;
use App\Http\Requests\BusinessCategoryRequest\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\BusinessCategory;
use Validator;
use Response;
use Session;
use Auth;
use Str;
use DB;

class BusinessCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Gate::authorize('app.dvision.index');
        $data['alldata']= BusinessCategory::all();
        return view('customer.business-category', $data);
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
        // Gate::authorize('app.BusinessCategorys.create');

        DB::beginTransaction();
        try{
            BusinessCategory::create($request->all());
            DB::commit();
            Session::flash('flash_message','Business Category Successfully Added !');
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
        // Gate::authorize('app.BusinessCategorys.edit');
        $data['single_data']= BusinessCategory::find($id);
        $data['alldata']= BusinessCategory::all();
        return view('customer.business-category', $data);
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
        // Gate::authorize('app.BusinessCategorys.edit');
        $data=BusinessCategory::findOrFail($id);
        try{
            $data->update($request->all());
            Session::flash('flash_message','BusinessCategory Successfully Updated !');
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
        // Gate::authorize('app.BusinessCategorys.destroy');
        try {
            $data = BusinessCategory::findOrFail($id);
            $data->delete();
            Session::flash('flash_message','Business Category Successfully Deleted !');
            return redirect()->back()->with('status_color','danger');
        } catch (\Exception $exception) {
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }
}

