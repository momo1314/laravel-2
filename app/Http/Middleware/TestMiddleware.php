<?php

namespace App\Http\Middleware;

use Closure;

class TestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $stu = $request->input('stuid','NULL');
        $class = $request->input('classid','NULL');
        if($stu != 'NULL'){
            if(intval($stu)<=2016200000||intval($stu)>=2016215000){
                return view('so');
            }
            else{
                return $next($request);
            }
        }
        if($class != 'NULL'){
            if(strlen($class)>8||strlen($class)<7){
                return view('so');
            }
            else{
                return $next($request);
            }
        }
        return view('so');
    }
}
