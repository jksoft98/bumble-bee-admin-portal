<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use DateTime;
class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $iss = [
            config('site-specific.api_url').'admin-login',
        ];

        if($token = $request->session()->get('access_token')){

            $tokenParts   = explode(".", $token);  
            $tokenPayload = base64_decode($tokenParts[1]);
            $jwtPayload   = json_decode($tokenPayload);

            if(in_array($jwtPayload->iss,$iss)){
                $getCurrenTtime = new DateTime();
                $currenttime = $getCurrenTtime->format('Y-m-d H:i:s');
                $convertTime = strtotime($currenttime);
                if($jwtPayload->exp > $convertTime){
                    return $next($request);
                }
            }
        }  
        
        $request->session()->flush();
        return redirect('/admin-login');    
    }
}
