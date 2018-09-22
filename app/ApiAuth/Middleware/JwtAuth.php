<?php

namespace App\ApiAuth\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
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
     * @param   string                  $guard
     * @param   bool                    $guest
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard, $guest = false)
    {
        try {
            $this->JWTValid($request, $guard, $guest);
        } catch (Exception $e) {
            if ($e instanceof TokenInvalidException) {
                throw new AccessDeniedHttpException('Token Error');
            } else if ($e instanceof TokenExpiredException) {
                throw new ConflictHttpException('Token Expired');
            } else {
                throw new HttpException(500, $e->getMessage());
            }
        }

        return $next($request);
    }

    /**
     * @param Request $request
     * @param         $guard
     * @param         $guest
     */
    private function JWTValid($request, $guard, $guest)
    {
        if (
            ($guest && $request->header('authorization')) ||
            ! $guest
        ) {
            auth($guard)->user();
            auth($guard)->payload();
        }
    }
}
