<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest\CreateRequest;
use App\Http\Requests\ProductRequest\UpdateRequest;
use App\Models\BusinessCategory;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Gate::authorize('app.product.index');
        if ($request->ajax()) {
           $alldata = Product::with('businessCategory')->get();
           return DataTables::of($alldata)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                ob_start() ?>

                <ul class="list-inline m-0">
                    <li class="list-inline-item">
                        <button data-id="<?php echo $row->id; ?>" class="badge bg-success badge-sm editProduct"><i class="icon-edit-3"></i></button>
                    </li>
                    <li class="list-inline-item">
                        <button data-id="<?php echo $row->id; ?>" class="badge bg-danger badge-sm button-delete"><i class="icon-delete"></i></button>
                    </li>
                </ul>

                <?php return ob_get_clean(); 
            })->make(true);
        }

        return view('business.products');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Gate::authorize('app.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        // Gate::authorize('app.product.create');
        try {
            Product::updateOrCreate(
                [
                    'id' => $request->product_id
                ],
                [
                    'name' => $request->name, 
                    'business_cat_id' => $request->business_cat_id
                ]
            );
            return response()->json(['success'=>'Product saved successfully.']);
        } catch (\Exception $exception) {
            return response()->json(['error'=>'Somthing went wrong!']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Gate::authorize('app.product.edit');
        try {
            $product = Product::find($id);
            return response()->json($product);
        } catch (\Exception $exception) {
            return response()->json($exception);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Gate::authorize('app.product.destroy');
        try {
            $data = Product::findOrFail($id);
            $data->delete();
            return response()->json(['success'=>'Product successfully deleted.']);
        } catch (\Exception $exception) {
            return response()->json(['error'=>'Somthing went wrong!']);
        }
    }

    // ajax part

    public function businessCategory(){
        $data = BusinessCategory::select('id','name')->get();
        return response()->json($data);
    }
}
