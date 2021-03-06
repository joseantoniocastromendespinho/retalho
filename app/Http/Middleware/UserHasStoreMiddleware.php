<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserHasStoreMiddleware
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
        if(Auth::user()->store()->count())
        {
            flash('Voce ja possui uma loja!')->warning();
            return redirect()->route('admin.stores.index');
        }
        
        
        return $next($request);
    }
}
