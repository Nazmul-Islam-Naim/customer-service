<?php

namespace App\Http\Controllers\Web;

use App\Enum\Status;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\StockProduct;
use App\Models\User;
use Session;
use Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['users'] = User::where('role_id',2)->count();
        $data['customers'] = Customer::count();
        $data['todayCustomers'] = Customer::where('date',date('Y-m-d'))->count();
        return view('user-home',$data);
    }

    // stock product chart
    public function stockProduct(){
        $out = 1 ;
        $low = 1 ;
        $ok = 1 ;
        $data = StockProduct::with('product')->get();
        foreach ($data as $key => $value) {
           if ($value->quantity > $value->product->stock_notify) {
            $alldata['ok'] = $ok++;
           } else if (($value->quantity > 0) && ($value->quantity <= $value->product->stock_notify)) {
            $alldata['low'] = $low++;
           }else{
            $alldata['out'] = $out++;
           }
        }
        return $alldata;
    }
    public function selectBranch()
    {
        return view('branchPanelPopup');
    }

    public function adminSelectedDashboard($branch_id)
    {
        if(Auth::user()->user_type == 1)
        {
            session(['branch_id' => $branch_id]);
            return redirect('user-home');
        }
    }
}
