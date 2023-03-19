<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\DistrictRequest\CreateRequest;
use App\Http\Requests\DistrictRequest\UpdateRequest;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\District;
use Validator;
use Response;
use Session;
use Auth;
use Str;
use DB;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Gate::authorize('app.dvision.index');
        $data['divisions']= Division::all();
        $data['alldata']= District::all();
        return view('area.district', $data);
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
        // Gate::authorize('app.Districts.create');

        DB::beginTransaction();
        try{
            District::create($request->all());
            DB::commit();
            Session::flash('flash_message','District Successfully Added !');
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
        // Gate::authorize('app.Districts.edit');
        $data['divisions']= Division::all();
        $data['single_data']= District::find($id);
        $data['alldata']= District::all();
        return view('area.district', $data);
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
        // Gate::authorize('app.Districts.edit');
        $data=District::findOrFail($id);
              
        $input = $request->all();
        try{
            $data->update($input);
            Session::flash('flash_message','District Successfully Updated !');
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
        // Gate::authorize('app.Districts.destroy');
        try {
            $data = District::findOrFail($id);
            $data->delete();
            Session::flash('flash_message','District Successfully Deleted !');
            return redirect()->back()->with('status_color','danger');
        } catch (\Exception $exception) {
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }
}

