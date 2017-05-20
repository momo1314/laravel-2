<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boards = DB::table('boards')
                    ->join('users','boards.userid','=','users.id')
                    ->select('users.name as name','boards.content as content','boards.created_at as time')
                    ->get();
        return view('home',['boards' => $boards]);
    }
}
