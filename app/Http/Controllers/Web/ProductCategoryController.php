<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCategoryRequest\CreateRequest;
use App\Http\Requests\ProductCategoryRequest\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\ProductCategory;
use Validator;
use Response;
use Session;
use Auth;
use Str;
use DB;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Gate::authorize('app.dvision.index');
        $data['alldata']= ProductCategory::all();
        return view('product.product-category', $data);
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
        // Gate::authorize('app.ProductCategorys.create');

        DB::beginTransaction();
        try{
            ProductCategory::create($request->all());
            DB::commit();
            Session::flash('flash_message','Product Category Successfully Added !');
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
        // Gate::authorize('app.ProductCategorys.edit');
        $data['single_data']= ProductCategory::find($id);
        $data['alldata']= ProductCategory::all();
        return view('product.product-category', $data);
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
        // Gate::authorize('app.ProductCategorys.edit');
        $data=ProductCategory::findOrFail($id);
        try{
            $data->update($request->all());
            Session::flash('flash_message','Product Category Successfully Updated !');
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
        // Gate::authorize('app.ProductCategorys.destroy');
        try {
            $data = ProductCategory::findOrFail($id);
            $data->delete();
            Session::flash('flash_message','Product Category Successfully Deleted !');
            return redirect()->back()->with('status_color','danger');
        } catch (\Exception $exception) {
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }
}

