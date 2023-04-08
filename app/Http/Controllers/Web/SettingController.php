<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSetting;
use App\Models\Currency;
use App\Models\User;
use App\Models\ThemeSetting;
use Validator;
use Response;
use Session;
use Auth;
use Hash;
use DB;

class SettingController extends Controller
{
    public function index()
    {
        return view('user.setting');
    }

    public function updateUserPassword(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed|min:6',
        ]);
        if ($validator->fails()) {
            Session::flash('flash_message', $validator->errors());
            return redirect()->back()->with('status_color','warning');
        }
        $data=User::findOrFail($id);
        $input = $request->all();
        $input['password'] = Hash::make($request->password);
        try{
            $data->update($input);
            Session::flash('flash_message','Password Changed.');
            return redirect()->back()->with('status_color','success');
        }catch(\Exception $e){
            Session::flash('flash_message','Something Error Found ! ');
            return redirect()->back()->with('status_color','danger');
        }
    }
}
