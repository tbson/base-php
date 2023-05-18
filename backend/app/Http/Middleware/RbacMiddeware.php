<?php

namespace App\Http\Middleware;

use Closure;
use Src\Util\CryptoUtil;
use Src\Util\RouterUtil;
use Src\Service\Role\PemService;
use Src\Service\Account\UserService;

/**
 * Class RbacMiddeware
 * @package App\Http\Middleware\RbacMiddeware
 */
class RbacMiddeware {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $jwtToken = CryptoUtil::getJwtTokenFromHeader($request->headers);
        [$status, $result] = CryptoUtil::getJwtTerms($jwtToken);

        if ($status !== "ok") {
            return self::onDeny(401);
        }

        $userId = $result["user_id"];
        $tokenPemIds = $result["pems"];
        $pemData = RouterUtil::getPemData($request->route());
        $conditions = ["module" => $pemData["module"], "action" => $pemData["action"]];
        [$status, $pem] = PemService::getPem($conditions);
        if ($status === "error") {
            return self::onDeny(403);
        }

        if (in_array($pem->id, $tokenPemIds) === false) {
            return self::onDeny(403);
        }

        [$status, $user] = UserService::getUser(["id" => $userId]);
        if ($status === "error") {
            return self::onDeny(403);
        }
        $request = $request->merge(["user" => $user]);
        return self::onAllow($request, $next);
    }

    private static function onAllow($request, Closure $next) {
        return $next($request);
    }

    private static function onDeny($statusCode) {
        return response()->json(
            [
                "detail" => $statusCode === 403 ? "Forbidden" : "Unauthorized",
            ],
            $statusCode,
        );
    }
}
