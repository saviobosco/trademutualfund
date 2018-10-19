<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;

class EnsurePhoneIsVerified
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
        if (! $request->user() || ! $request->user()->hasVerifiedPhone()) {
            return $request->expectsJson()
                ? abort(403, 'Your phone is not verified.')
                : Redirect::route('phone_verification.notice');
        }

        return $next($request);
    }
}
