<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * Usage:
     *   ->middleware('session.auth')           must be logged in, otherwise redirected to login
     *   ->middleware('session.auth:guest')     must NOT be logged in, otherwise redirected to home.
     *                                          Also blocks typing /login directly - the login page
     *                                          can only be reached by clicking links inside the app,
     *                                          because those requests carry a same-site Referer.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $mode = 'auth'): Response
    {
        $isLoggedIn = $request->session()->get('logged_in') === true;

        if ($mode === 'guest') {
            if ($isLoggedIn) {
                return redirect()->route('home');
            }

            /*
             * Block direct URL access: navigating from within the app
             * (clicking the Login buttons) always sends a Referer header,
             * while typing the address does not.
             */
            if ($request->isMethod('GET')) {
                $referer = (string) $request->header('referer');

                if (! str_contains($referer, (string) $request->getHost())) {
                    return redirect()->route('home');
                }
            }
        }

        if ($mode === 'auth' && ! $isLoggedIn) {
            return redirect()
                ->route('login')
                ->with('error', 'Please log in first.');
        }

        return $next($request);
    }
}
