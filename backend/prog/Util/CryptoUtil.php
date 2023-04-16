<?php
namespace Prog\Util;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Hash;
use Prog\Util\TimeUtil;

/**
 * Class CryptoUtil
 * @package Prog\Util\CryptoUtil
 */
class CryptoUtil
{
    public static function hashPwd($rawPwd)
    {
        return Hash::make($rawPwd);
    }

    private static function getJwtPrivateKey()
    {
        $passphrase = env("JWT_PASSPHASE");
        $privateKeyFile = base_path(env("JWT_PRIVATE_KEY"));
        return openssl_pkey_get_private(
            file_get_contents($privateKeyFile),
            $passphrase
        );
    }

    private static function getJwtPublicKey()
    {
        $privateKey = self::getJwtPrivateKey();
        return openssl_pkey_get_details($privateKey)["key"];
    }

    public static function encodeJwt($userId, $pems = null)
    {
        try {
            if (is_null($pems)) {
                $pems = [0];
            }
            $JWT_EXPIRATION_PERIOD = env("JWT_EXPIRATION_PERIOD");
            $now = TimeUtil::now();
            $expiry = TimeUtil::now()->modify("+{$JWT_EXPIRATION_PERIOD} seconds");
            $privateKey = self::getJwtPrivateKey();

            $payload = [
                "iss" => env("APP_DOMAIN"),
                "aud" => env("APP_DOMAIN"),
                "iat" => $now->getTimestamp(),
                "exp" => $expiry->getTimestamp(),
                "user_id" => $userId,
                "pems" => implode(",", $pems),
            ];
            dump($payload);

            return ["ok", JWT::encode($payload, $privateKey, "RS256")];
        } catch (\Exception $e) {
            return ["error", "Can not encode JWT token"];
        }
    }

    public static function decodeJwt($jwtToken)
    {
        try {
            $publicKey = self::getJwtPublicKey();
            return ["ok", JWT::decode($jwtToken, new Key($publicKey, "RS256"))];
        } catch (\Exception $e) {
            return ["error", "Can not decode JWT token"];
        }
    }

    public static function getJwtTerms($jwtToken)
    {
        $message = "Can not decode JWT token";
        try {
            [$status, $payload] = self::decodeJwt($jwtToken);
            if ($status !== "ok") {
                return ["error", $message];
            }
            return [
                "ok",
                [
                    "user_id" => $payload->user_id,
                    "pems" => array_map("intval", explode(",", $payload->pems)),
                ],
            ];
        } catch (\Exception $e) {
            return ["error", $message];
        }
    }
}
