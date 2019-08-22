<?php
namespace App\Http\Middleware;

use Closure;

class Checklogin{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->session()->has('user_data')){
            return redirect('/user/login')->with('alert-danger', 'You must login !');
        }
        
        return $next($request);
    }
}