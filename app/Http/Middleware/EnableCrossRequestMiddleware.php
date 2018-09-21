<?php
namespace App\Http\Middleware;
use Closure;
class EnableCrossRequestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $origin = $request->server('HTTP_ORIGIN') ? $request->server('HTTP_ORIGIN') : '';
        $allowOrigin = [
            'http://localhost:8080',
        ];

        if (in_array($origin, $allowOrigin)) {
            $response->header('Access-Control-Allow-Origin', $origin);
            $response->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Cookie, X-CSRF-TOKEN, X-URL-PATH,x-access-token,Accept, Authorization, X-XSRF-TOKEN');
            $response->header('Access-Control-Expose-Headers', 'Authorization, authenticated');
            $response->header('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT, OPTIONS');
            $response->header('Access-Control-Allow-Credentials', 'true');
        }
        return $response;
    }

    public function handle_bak($request, Closure $next)
    {
        if ($request->getMethod() == "OPTIONS") {
            return response('', 200)->withHeaders([
                'Access-Control-Allow-Origin' => 'http://localhost:8080',
                'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE',
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Allow-Headers' => 'Content-Type',
            ]);
        }

        header('Access-Control-Allow-Origin: http://localhost:8080');
        header('Access-Control-Allow-Headers: Content-Type,accept');
        return $next($request);
    }
}