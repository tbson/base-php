<?php
namespace Prog\Util;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Hash;
use Prog\Util\TimeUtil;

/**
 * @module Prog\Util\CryptoUtil;
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

    public static function encode($userId, $pems = null)
    {
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

        return JWT::encode($payload, $privateKey, "RS256");
    }

    public static function decode($jwtToken)
    {
        $publicKey = self::getJwtPublicKey();
        return JWT::decode($jwtToken, new Key($publicKey, "RS256"));
    }
}
