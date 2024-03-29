<?php
namespace App\Http\Middleware;

use Closure;

class CheckloginAdmin{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->session()->has('user_data_admin')){
            return redirect('/admin/login')->with('alert-danger', 'You must login !');
        }
        
        return $next($request);
    }
}