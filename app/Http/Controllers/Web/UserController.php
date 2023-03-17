<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Arr;
use Intervention\Image\Facades\Image;
use Validator;
use Response;
use Session;
use Auth;
use Hash;
use DB;
use DataTables;
use Illuminate\Support\Facades\Gate;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('app.users.index');
        if ($request->ajax()) {
            $alldata= User::with(['department','designation','role'])
                            ->where('status', '1')
                            ->get();
            return DataTables::of($alldata)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                ob_start() ?>
                
                <ul class="list-inline m-0">
                    <li class="list-inline-item">
                        <a href="<?php echo route('user-list.edit', $row->id); ?>" class="badge bg-primary badge-sm" data-id="<?php echo $row->id; ?>"><i class="icon-edit-3"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <button data-id="<?php echo $row->id; ?>" class="badge bg-danger badge-sm button-delete"><i class="icon-delete"></i></button>
                    </li>
                </ul>

            <?php return ob_get_clean();
            })->make(True);
        }
        return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.users.create');
        $data['roles']= Role::all();
        $data['designations']= Designation::all();
        $data['departments']= Department::all();
        return view('user.add-user', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('app.users.create');
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:255',
            'email' => 'nullable|email|unique:users',
            'phone' => 'required|max:15|unique:users',
            'password' => 'required|min:6',
            'role_id' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
            'avatar' => 'nullable|image',
        ]);
        if ($validator->fails()) {
            Session::flash('flash_message', $validator->errors());
            return redirect()->back()->with('status_color','warning');
        }
        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        if(Arr::has($data, 'avatar')){
            $data['avatar'] = (Arr::pull($data, 'avatar'));
            Image::make($data['avatar'])->resize(600,500);
            $data['avatar'] = (Arr::pull($data, 'avatar'))->store('brands');
        }

        try{
            $insert = User::create($data);
            Session::flash('flash_message','User Successfully Added !');
            return redirect()->back()->with('status_color','success');
        }catch(\Exception $e){
            Session::flash('flash_message','Faild to create user!');
            return redirect()->back()->with('status_color','danger');
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
        Gate::authorize('app.users.edit');
        $data['roles']= Role::all();
        $data['designations']= Designation::all();
        $data['departments']= Department::all();
        $data['single_data']=User::findOrFail($id);
        return view('user.add-user', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Gate::authorize('app.users.edit');
        $data=User::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'role_id'=>'required|integer',
            'department_id'=>'required|integer',
            'designation_id'=>'required|integer',
            'email' => 'required|unique:users,email,'.$data->id
        ]);
        if ($validator->fails()) {
            Session::flash('flash_message', $validator->errors());
            return redirect()->back()->with('status_color','warning');
        }
        
        $input = $request->all();

        // user image
        if ($request->hasFile('image')) {
            $photo=$request->file('image');
            $fileType=$photo->getClientOriginalExtension();
            // dd($fileType);
            $fileName=rand(1,1000).date('dmyhis').".".$fileType;
            Image::make($photo)->resize(144,144)->save(public_path('upload/user/'.$fileName));
            $input['image']=$fileName;
        }
            
        if ($request->password !="") {
            $input['password'] = Hash::make($request->password);
            $input['password_hint'] = $request->password;
        }else{
            $input['password'] = $data->password;
        }

        try{
            $data->update($input);
            Session::flash('flash_message','Data Successfully Updated !');
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
    public function destroy(User $user)
    {
        Gate::authorize('app.users.delete');
        $user->delete();
        Session::flash('flash_message','User Successfully Updated !');
        return redirect()->back()->with('status_color','warning');
    }

    // user list by yarja data table

}
