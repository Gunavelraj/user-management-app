<?php

namespace App\Http\Controllers;



use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Http\RedirectResponse;
use Redirect;
use Illuminate\Support\Facades\Session;



class UserManagementController extends Controller
{
    public function index(Request $request)
    {

        $users = User::all();
        Session::forget('requestData');
        Session::forget('editStatus');
        return view('users.lists',['users'=> $users]);
    }

    public function create()
    {
        // Session::forget('requestData');
        return view('users.create');
    }

    public function store(Request $request)
    {
        try {
            Session::put('requestData', $request->all());

            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'role' => 'required|in:admin,supervisor,agent',
                'email' => 'required|email|unique:users',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
                'date_of_birth' => 'required|date',
                'timezone' => 'required|string',
                'password' => 'required|string|min:8',
                'confirm_password' => 'required|string|same:password',
            ]);

            if($validator->fails()) {
                return Redirect::back()->withErrors($validator);
            }
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'role' => $request->role,
                'email' => $request->email,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'date_of_birth' => $request->date_of_birth,
                'timezone' => $request->timezone,
                'password' => bcrypt($request->password),
            ]);
            if($user){
                Session::forget('requestData');
            }

            return redirect()->route('users.index')->with('message',"User successfully registered");

        } catch (\Throwable $th) {
            return redirect()->route('users.index')->with('error',"Somthing Error");
        }
    }
    public function edit($id){
        $edit_user = User::select('id','first_name','last_name', 'role', 'email', 'latitude', 'longitude','date_of_birth', 'timezone')->where('id', $id)->first();
        if($edit_user){
            if(Session::get('editStatus') == false || Session::get('editStatus') == ''){
                Session::put('requestData', $edit_user);
                Session::put('editStatus', true);
            }
            return view('users.edit',['user' => $edit_user]);
        }else{
            return redirect()->route('users.index')->with('error',"Not a valid id");
        }
    }

    public function update(Request $request)
    {
        try {
            Session::put('requestData', $request->all());
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'role' => 'required|in:admin,supervisor,agent',
                'email' => 'required|email|unique:users,email,' . $request->user_id,
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
                'date_of_birth' => 'required|date',
                'timezone' => 'required|string',
                'password' => 'required|string|min:8',
                'confirm_password' => 'required|string|same:password',
            ]);

            if($validator->fails()) {
                return Redirect::back()->withErrors($validator);
            }
            $update_user = User::where('id',$request->user_id)->first();

            $update_user->first_name = $request->first_name;
            $update_user->last_name = $request->last_name;
            $update_user->role = $request->role;
            $update_user->email = $request->email;
            $update_user->latitude = $request->latitude;
            $update_user->longitude = $request->longitude;
            $update_user->date_of_birth = $request->date_of_birth;
            $update_user->timezone = $request->timezone;
            $update_user->password = bcrypt($request->password);
            $update_user->save();

            Session::forget('requestData');
            return redirect()->route('users.index')->with('message',"User successfully updated");

        } catch (\Throwable $th) {
            return redirect()->route('users.index')->with('error',"Somthing Error");
        }
    }
    public function delete($id){
        $delete_user = User::where('id', $id)->first();
        if($delete_user){
            $delete_user->delete();
            return redirect()->route('users.index')->with('message',"User successfully deleted");
        }else{
            return redirect()->route('users.index')->with('error',"Not a valid id");
        }
    }
}
