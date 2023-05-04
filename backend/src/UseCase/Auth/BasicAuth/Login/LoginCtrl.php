<?php

namespace Src\UseCase\Auth\BasicAuth\Login;

use Illuminate\Http\Request;
use Src\Util\ResUtil;
use Src\Service\Account\AccountService;
use Src\Service\Account\UserService;
use Src\UseCase\Auth\BasicAuth\Login\LoginFlow;
use Src\UseCase\Auth\BasicAuth\Login\LoginValidator;
use Src\UseCase\Auth\BasicAuth\Login\LoginPresenter;

/**
 * Class LoginCtrl
 * @package Src\UseCase\Auth\BasicAuth\Login\LoginCtrl
 */
class LoginCtrl {
    public function login(Request $request) {
        $data = $request->all();
        [$status, $result] = LoginValidator::validateLogin($data);
        if ($status === "error") {
            return ResUtil::err($result);
        }
        $username = $result["username"];
        $password = $result["password"];
        $flow = new LoginFlow(new AccountService(), new UserService());

        [$status, $result] = $flow->login($username, $password);
        if ($status === "error") {
            return ResUtil::err($result);
        }
        [$user, $token] = $result;
        $response = LoginPresenter::presentLogin($user, $token);

        return ResUtil::res($response);
    }
}
