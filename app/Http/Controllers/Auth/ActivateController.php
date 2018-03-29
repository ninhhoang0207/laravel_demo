<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Redirect, Session;

class ActivateController extends Controller
{
    public function active($active_code) {
    	$user = User::where('active_code', $active_code)->first();
    	if(count($user) > 0) {
    		$user->is_active = 1;
    		$user->active_code = null;
    		$user->save();
    		Session::flash('success', trans('auth.activate_success'));

    	} else {
    		Session::flash('error', trans('auth.activate_error'));
    	}
        
        return Redirect::route('login');
    }
}
