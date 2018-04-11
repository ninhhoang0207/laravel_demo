<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;
use Validator, Redirect, Session, DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'User';
        $users = User::all();

        return view('admin.user.index', compact(['title', 'users']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'User | Create';
        $roles = Role::all();

        return view('admin.user.create', compact(['title', 'roles']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'         =>  'required|unique:users|max:255',
            'name'          =>  'required',
            'password'      =>  'required|confirmed',
            'roles'         =>  'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        DB::beginTransaction();
        try {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->birthday = Carbon::parse($this->formatDate($request->birthday));
            $user->is_active = 1;
            if ($request->avatar) {
                $user->avatar = $this->moveFile('user/avatar' ,$request->avatar);
            }
            $user->save();
            $user->assignRole($request->roles);
            DB::commit();   
        } catch (Exception $e) {
            
            DB::rollback();
            dd($e);
        }
        
        Session::flash('success', 'Create user success.');

        return Redirect::route('admin.user.index');
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
        $title = 'User | Edit';
        $user = User::where('id', $id)->firstOrFail();
        $roles = Role::all();

        return view('admin.user.edit', compact(['title', 'user', 'roles']));
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
        $validator = Validator::make($request->all(), [
            'name'          =>  'required',
            'password'      =>  'confirmed',
            'roles'         =>  'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        DB::beginTransaction();
        try {
            $user = User::where('id', $id)->firstOrFail();
            $user->name = $request->name;
            $user->password = $request->password?bcrypt($request->password):$user->password;
            // $user->role = $request->role;
            $user->is_active = 1;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->birthday = isset($request->birthday) ? Carbon::parse($this->formatDate($request->birthday)) : null;
            if ($request->avatar) {
                $user->avatar = $this->moveFile('user/avatar', $request->avatar);
            }
            $user->save();
            $user->syncRoles($request->roles);
            DB::commit();
        } catch (Exception $e) {
            
            DB::rollback();
            dd($e);
        }
        
        Session::flash('success', 'Update user success.');

        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();
        // DB::table('role_user')->where('user_id', $id)->delete();

        Session::flash('success', 'Remove item success');

        return Redirect::route('admin.user.index');
    }
}
