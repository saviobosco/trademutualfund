<?php

namespace App\Http\Middleware;

use Closure;
use App\ReferralLink;
class StoreReferralCode
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
        $response = $next($request);
        if ($request->has('ref')){
            $referral = ReferralLink::whereCode($request->get('ref'))->first();
            $response->cookie('ref', $referral->id, 24 * 60 * 7);
        }
        return $response;
    }
}
