<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\FolloupRequest\CreateRequest;
use App\Models\Area;
use App\Models\Customer;
use App\Models\FollowUp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $customer = Customer::findOrFail($request->customer_id);
        
        try{
            FollowUp::create([
                'customer_id' => $customer->id,
                'area_id' => $customer->area_id,
                'division_id' => $customer->division_id,
                'district_id' => $customer->district_id,
                'date' => date('Y-m-d'),
                'question1' => $request->question1,
                'question2' => $request->question2,
                'question3' => $request->question3,
                'question4' => $request->question4,
                'question5' => $request->question5,
                'comment' => $request->comment,
            ]);
            
            Session::flash('flash_message','Follow Up Successfully Done !');
            return redirect()->route('clients',$customer->area_id)->with('status_color','success');
        }catch(\Exception $e){
            dd($e->getMessage());
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
            
        }
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

    /**
     * follow up form.
     */
    public function followUp($id){
        $customer = Customer::findOrFail($id);
        return view('followUp.form',compact('customer'));
    }
    
    /**
     * follow up report.
     */
    public function followUpReport(Request $request)
    {
        
        if ($request->ajax()) {
            if ($request->start_date != '' && $request->end_date != '') {
                $alldata= FollowUp::with(['customer','area','division', 'district'])
                    ->whereBetween('date',[$request->start_date, $request->end_date])
                    ->get();
                return DataTables::of($alldata)
                    ->addIndexColumn()->make(True);
               
            } else {
                $alldata= FollowUp::with(['customer','area','division', 'district'])
                    ->get();
                return DataTables::of($alldata)
                    ->addIndexColumn()->make(True);
                }
        }

        return view('followUp.report');
    }
}
