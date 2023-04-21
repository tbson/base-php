<?php

namespace Src\UseCase\Auth\BasicAuth;

use Illuminate\Http\Request;
use Src\UseCase\Auth\BasicAuth\BasicAuthValidator;
use Src\UseCase\Auth\BasicAuth\BasicAuthPresenter;
use Src\Service\Account\UserService;
use Src\UseCase\Auth\BasicAuth\BasicAuthFlow;

class BasicAuthCtrl
{
    public function login(Request $request)
    {
        $data = $request->all();
        [$status, $result] = BasicAuthValidator::validateLogin($data);
        if ($status === "error") {
            return response()->json($result, 400);
        }
        $username = $result["username"];
        $password = $result["password"];
        $flow = new BasicAuthFlow(new UserService());

        [$status, $result] = $flow->login($username, $password);
        if ($status === "error") {
            return response()->json($result, 400);
        }
        [$user, $token] = $result;
        $response = BasicAuthPresenter::presentLogin($user, $token);

        return response()->json($response);
    }

    public function changePwd()
    {
    }

    public function resetPwd()
    {
    }
}
