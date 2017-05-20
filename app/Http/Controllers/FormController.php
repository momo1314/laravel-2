<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class FormController extends Controller
{
    public function index(Request $request){
        $user = $request->user();
        $time = date('Y-h-d H:i:s',time());
        $isinserted = DB::table('boards')->insert([
            'userid'    =>  $user->id,
            'content'   =>  $request->input('content'),
            'created_at'=>  $time,
            'updated_at'=>  $time
        ]);
        echo $isinserted;
    }
}
