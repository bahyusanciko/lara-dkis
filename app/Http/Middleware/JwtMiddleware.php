<?php

    namespace App\Http\Middleware;

    use Closure;
    use JWTAuth;
    use Exception;
    use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

    class JwtMiddleware extends BaseMiddleware
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
            try {
                $user = JWTAuth::parseToken()->authenticate();
            } catch (Exception $e) {
                if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                    $message = 'Token is Invalid';
                }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                    $message = 'Token is Expired';
                }else{
                    $message = 'Authorization Token not found';
                }

                $data = [
                    "response" => [
                        "status" => false,
                        "data" => null,
                        "message" => $message
                    ],
                    "code" => 500
                ];
                return response()->json($data['response'], $data['code']);
            }
            return $next($request);
        }
    }