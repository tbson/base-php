<?php
namespace Src\UseCase\Auth;

use Src\Util\CryptoUtil;
use Src\Service\Role\Schema\GroupSchema;
use Src\Service\Account\Schema\UserSchema;
use Src\Util\ErrorUtil;

/**
 * Class AuthHelper
 * @package Src\UseCase\Auth\AuthHelper
 */
class AuthHelper
{
    public static function getUserPemIds($userId)
    {
        $user = UserSchema::find($userId);
        if (is_null($user)) {
            return ["error", ErrorUtil::parse("User not found")];
        }
        $groupIds = json_decode($user->group_ids);
        $groups = GroupSchema::whereIn("id", $groupIds)->get();
        $pems = [];
        foreach ($groups as $group) {
            $pems = array_merge(
                $pems,
                $group
                    ->pem()
                    ->get()
                    ->pluck("id")
                    ->toArray()
            );
        }
        return ["ok", $pems];
    }

    public static function generateUserToken($userId)
    {
        [$status, $result] = self::getUserPemIds($userId);
        if ($status === "error") {
            return $result;
        }
        $pems = $result;
        return CryptoUtil::encodeJwt($userId, $pems);
    }
}
