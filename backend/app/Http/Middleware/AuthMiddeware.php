<?php

namespace App\Http\Middleware;

use Closure;
use Src\Util\CryptoUtil;
use Src\Service\Account\UserService;

/**
 * Class AuthMiddeware
 * @package App\Http\Middleware\AuthMiddeware
 */
class AuthMiddeware
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
        $jwtToken = CryptoUtil::getJwtTokenFromHeader($request->headers);
        [$status, $result] = CryptoUtil::getJwtTerms($jwtToken);

        if ($status !== "ok") {
            return self::onDeny(403);
        }

        $userId = $result["user_id"];

        $user = UserService::getUser(["id" => $userId]);
        if ($user === null) {
            return self::onDeny(401);
        }
        $request->merge(["user" => $user]);
        return self::onAllow($request, $next);
    }

    private static function onAllow($request, Closure $next)
    {
        return $next($request);
    }

    private static function onDeny($statusCode)
    {
        return response()->json(
            [
                "detail" => $statusCode === 403 ? "Forbidden" : "Unauthorized",
            ],
            $statusCode
        );
    }
}
