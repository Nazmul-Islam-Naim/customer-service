<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Customer;
use App\Models\FollowUp;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FollowUpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

           $data = FollowUp::with('customer', 'customer.businessCategory', 'customer.area', 'customer.area.district', 'customer.area.district.division','user')->get();

           return DataTables::of($data)
           ->addIndexColumn()->make(true);

        }

        $areas = Area::all();

        return view('followUp.area',compact('areas'));
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
        dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * area wise client.
     */
    public function client(Request $request, $id)
    {
        if ($request->ajax()) {
            $alldata= Customer::with(['businessCategory','area','area.district', 'area.district.division', 'user'])
                ->where('area_id',$id)
                ->get();
            return DataTables::of($alldata)
                ->addIndexColumn()
                ->addColumn('action',function($row){
                    ob_start() ?>

                        <ul class="list-inline m-0">
                            <li class="list-inline-item">
                                <a href="<?php echo route('follow-ups', $row->id); ?>" class="badge bg-primary badge-sm" data-id="<?php echo $row->id; ?>"><i class="icon-eye"></i> Follow</a>
                            </li>
                        </ul>

                    <?php return ob_get_clean();
                })->make(True);
            }

        $area = Area::findOrFail($id);

        return view('followUp.client',compact('area'));
    }

    public function followUp($id){
        $customer = Customer::findOrFail($id);
        return view('followUp.form',compact('customer'));
    }
}
