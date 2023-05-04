<?php

namespace Src\UseCase\Auth\BasicAuth\ChangePwd;

use Src\Util\CryptoUtil;
use Src\Util\ErrorUtil;

/*
 * @module Src\UseCase\Auth\BasicAuth\ChangePwd\ChangePwdFlow;
 */
class ChangePwdFlow {
    public function changePwd($user, $password, $newPassword, $newPasswordConfirm) {
        # Check user enabled
        if (!$user->enabled) {
            $error = ErrorUtil::parse("User is not enabled");
            return ["error", $error];
        }

        # Check password
        if (!CryptoUtil::checkPwd($password, $user->password)) {
            $error = ErrorUtil::parse("Password not match");
            return ["error", $error];
        }

        # Check password and passwordNew match
        if ($newPassword !== $newPasswordConfirm) {
            $error = ErrorUtil::parse("Password and new password not match");
            return ["error", $error];
        }

        # Update password
        $user->password = $newPassword;
        $user->save();

        return ["ok", $user];
    }
}
