<?php

namespace App\ApiAuth\Middleware;

use Closure;
use Exception;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class JwtAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @param                           $guard
     * @param                           $guest
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard, $guest = false)
    {
        try {
            $this->validJwt($request, $guard, $guest);
        } catch (Exception $e) {
            if ($e instanceof TokenInvalidException) {
                throw new AccessDeniedHttpException('Token Error');
            } else if ($e instanceof TokenExpiredException) {
                throw new ConflictHttpException('Token Expired');
            } else {
                throw new HttpException($e->getMessage());
            }
        }

        return $next($request);
    }

    /**
     * @param $request
     * @param $guard
     * @param $guest
     */
    private function validJwt($request, $guard, $guest)
    {
        if ($guest && $request->header('authorization')) {
            $this->parseJwt($guard);
        } elseif ( ! $guest) {
            $this->parseJwt($guard);
        }
    }

    /**
     * @param $guard
     */
    private function parseJwt($guard)
    {
        auth()->guard($guard)->user();
        auth()->guard($guard)->payload();
    }
}
