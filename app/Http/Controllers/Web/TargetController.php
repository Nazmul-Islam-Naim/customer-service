<?php

namespace App\Http\Controllers\Web;

use App\Enum\Month;
use App\Enum\Year;
use App\Http\Controllers\Controller;
use App\Http\Requests\TargetRequest\CreateRequest;
use App\Models\RegistrationTargetCurrent;
use App\Models\RegistrationTargetMonthly;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class TargetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize('app.users.index');
        if ($request->ajax()) {
            $alldata= User::with(['designation','role', 'division', 'district','areas','target'])
                            ->where([['role_id',2],['status',1]])
                            ->get();
            return DataTables::of($alldata)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                ob_start() ?>
                
                <ul class="list-inline m-0">
                    <li class="list-inline-item">
                        <button data-id="<?php echo $row->id; ?>" class="badge bg-success badge-sm editProduct"><i class="icon-plus-circle"></i></button>
                    </li>
                </ul>

            <?php return ob_get_clean();
            })->make(True);
        }
        return view('target.set-target');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['months'] = Month::getCases();
        $data['years'] = Year::getCases();
        return view('target.target-form',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        try {

            $users = User::where('role_id',2)->get();

            $countMonthYear = RegistrationTargetCurrent::where([['month',$request->month],['year',$request->year]])->count();

            if ($countMonthYear > 0) {
                Session::flash('flash_message','Target already generated!');
                return redirect()->route('targets.index')->with('status_color','warning');
            } else {            
                foreach ($users as $value) {
                    RegistrationTargetCurrent::updateOrCreate(
                        [
                            'user_id' => $value->id
                        ],
                        [
                            'month' => $request->month,
                            'year' => $request->year,
                            'target' => $request->target,
                            'recovery' => 0,
                        ],
                    );
    
                    RegistrationTargetMonthly::create(
                        [
                            'user_id' => $value->id,
                            'month' => $request->month,
                            'year' => $request->year,
                            'target' => $request->target,
                            'recovery' => 0,
                        ],
                    );
                }
                Session::flash('flash_message','Target successfully generate.');
                return redirect()->route('targets.index')->with('status_color','success');
            }
        } catch (\Exception $exception) {
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
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
}
