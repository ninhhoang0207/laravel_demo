<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Carbon\Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function formatDate($date = null) {
    	if (isset($date)) {
    		$date = str_replace('/', '-', $date);
    		$date = Carbon::parse($date)->format('Y-m-d');
    	}

    	return $date;
    }

    public function moveFile($folder, $file) {
        $name = substr(sha1(rand()), 0, 8).time().'.'.$file->getClientOriginalExtension();
        $file->move($folder, $name);

        return $folder.'/'.$name;
    }
}
