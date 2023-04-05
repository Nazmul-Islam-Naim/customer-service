<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest\CreateRequest;
use App\Http\Requests\CustomerRequest\UpdateRequest;
use App\Models\Area;
use App\Models\BusinessCategory;
use App\Models\District;
use App\Models\Division;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;
use App\Models\Customer;
use Intervention\Image\Facades\Image;
use Stevebauman\Location\Facades\Location;
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
                ->addIndexColumn()
                ->addColumn('action',function($row){
                    ob_start() ?>

                        <ul class="list-inline m-0">
                            <li class="list-inline-item">
                                <a href="<?php echo route('customers.edit', $row->id); ?>" class="badge bg-primary badge-sm" data-id="<?php echo $row->id; ?>"><i class="icon-edit-3"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <button data-id="<?php echo $row->id; ?>" class="badge bg-danger badge-sm button-delete"><i class="icon-delete"></i></button>
                            </li>
                        </ul>

                    <?php return ob_get_clean();
                })->make(True);
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
        $areas = auth()->user()->areas;
        $bCategories = BusinessCategory::select('id','name')->get();
        return view('customer.create-edit-form',['areas' => $areas, 'bCategories' => $bCategories]);
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

        $ipAddress = '103.86.199.121';

        $location = Location::get($ipAddress);
        $data = $request->all();
        $data['lat'] = $location->latitude;
        $data['long'] = $location->longitude;
        $data['division_id'] = auth()->user()->division_id;
        $data['district_id'] = auth()->user()->district_id;
        $data['user_id'] = auth()->user()->id;

        if(Arr::has($data, 'avatar')){
            $data['avatar'] = (Arr::pull($data, 'avatar'));
            Image::make($data['avatar'])->resize(600,600);
            $data['avatar'] = (Arr::pull($data, 'avatar'))->store('customer-avatar');
        }
        
        try{
            DB::beginTransaction();
            $customer = Customer::create($data);
            $customer->products()->attach($request->product_id);
            DB::commit();
            Session::flash('flash_message','Customer Successfully Added !');
            return redirect()->route('customers.index')->with('status_color','success');
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
        $allproducts = [];
        $areas = auth()->user()->areas;
        $bCategories = BusinessCategory::select('id','name')->get();
        $products = Product::select('id','name')->get();
        $single_data = Customer::find($id);
        foreach ($single_data->products as  $value) {
            $allproducts[] = $value->id;
        }
        return view('customer.create-edit-form', ['areas' => $areas, 'bCategories' => $bCategories, 'products' => $products, 'single_data' => $single_data, 'allproducts' => $allproducts]);
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
        $customer = Customer::findOrFail($id);
        $ipAddress = '103.86.199.121';

        $location = Location::get($ipAddress);
        $data = $request->all();
        $data['lat'] = $location->latitude;
        $data['long'] = $location->longitude;
        $data['division_id'] = auth()->user()->division_id;
        $data['district_id'] = auth()->user()->district_id;
        $data['user_id'] = auth()->user()->id;

        if(Arr::has($data, 'avatar')){
            $data['avatar'] = (Arr::pull($data, 'avatar'));
            Image::make($data['avatar'])->resize(600,600);
            $data['avatar'] = (Arr::pull($data, 'avatar'))->store('customer-avatar');
        }

        try{
            DB::beginTransaction();
            $customer->update($data);
            $customer->products()->sync($request->product_id);
            DB::commit();
            Session::flash('flash_message','Customer Successfully Updated !');
            return redirect()->route('customers.index')->with('status_color','warning');
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function customerMap($id)
    {
        $data['customer'] = Customer::findOrFail($id);
        return view('customer.customer-map',$data);
    }

   /**
     * get product id by business categories id.
     *
     * @param  int  $businessCategoryId
     * @return \Illuminate\Http\Response
     */ 

     public function productsByCategory(Request $request){
        $products = Product::where('business_cat_id',$request->businessCategoryId)->get();
        return response()->json($products);
     }
   /**
     * get customer lat long.
     *
     * @return \Illuminate\Http\Response
     */ 

     public function getLatLong(Request $request){
        $latLong = Customer::select('name','lat','long')->get();
        return response()->json($latLong);
     }
   /**
     * get customer today lat long.
     *
     * @return \Illuminate\Http\Response
     */ 

     public function getTodayLatLong(Request $request){
        $latLong = Customer::where('date',date('Y-m-d'))->select('name','lat','long')->get();
        return response()->json($latLong);
     }
}

