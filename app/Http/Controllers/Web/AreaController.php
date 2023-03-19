<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\AreaRequest\CreateRequest;
use App\Http\Requests\AreaRequest\UpdateRequest;
use App\Models\District;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Area;
use Validator;
use Response;
use Session;
use Auth;
use Str;
use DB;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Gate::authorize('app.dvision.index');
        $data['districts']= District::all();
        $data['users']= User::all();
        $data['alldata']= Area::all();
        return view('area.area', $data);
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
        // Gate::authorize('app.departments.create');

        DB::beginTransaction();
        try{
            Area::create($request->all());
            DB::commit();
            Session::flash('flash_message','Area Successfully Added !');
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
        // Gate::authorize('app.Areas.edit');
        $data['single_data']= Area::find($id);
        $data['districts']= District::all();
        $data['users']= User::all();
        $data['alldata']= Area::all();
        return view('area.area', $data);
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
        // Gate::authorize('app.Areas.edit');
        $data=Area::findOrFail($id);
              
        try{
            $data->update($request->all());
            Session::flash('flash_message','Area Successfully Updated !');
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
        // Gate::authorize('app.Areas.destroy');
        try {
            $data = Area::findOrFail($id);
            $data->delete();
            Session::flash('flash_message','Area Successfully Deleted !');
            return redirect()->back()->with('status_color','danger');
        } catch (\Exception $exception) {
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }
}

