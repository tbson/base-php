<?php

namespace Src\UseCase\Auth\BasicAuth\Login;

use Illuminate\Http\Request;
use Src\UseCase\Auth\BasicAuth\Login\BasicAuthLoginValidator;
use Src\UseCase\Auth\BasicAuth\Login\BasicAuthLoginPresenter;
use Src\Service\Account\AccountService;
use Src\Service\Account\UserService;
use Src\UseCase\Auth\BasicAuth\Login\BasicAuthLoginFlow;

/**
 * Class BasicAuthLoginCtrl
 * @package Src\UseCase\Auth\BasicAuth\Login\BasicAuthLoginCtrl
 */
class BasicAuthLoginCtrl {
    public function login(Request $request) {
        $data = $request->all();
        [$status, $result] = BasicAuthLoginValidator::validateLogin($data);
        if ($status === "error") {
            return response()->json($result, 400);
        }
        $username = $result["username"];
        $password = $result["password"];
        $flow = new BasicAuthLoginFlow(new AccountService(), new UserService());

        [$status, $result] = $flow->login($username, $password);
        if ($status === "error") {
            return response()->json($result, 400);
        }
        [$user, $token] = $result;
        $response = BasicAuthLoginPresenter::presentLogin($user, $token);

        return response()->json($response);
    }
}
