<?php

namespace Src\UseCase\Auth\CommonAuth;

use Src\UseCase\Auth\AuthHelper;
use Src\Util\CryptoUtil;

/**
 * Class CommonAuthFlow
 * @package Src\UseCase\Auth\CommonAuth\CommonAuthFlow
 */
class CommonAuthFlow
{
    /*
    private $authService;
    private $authRepository;

    public function __construct(
        AuthService $authService,
        AuthRepository $authRepository
    ) {
        $this->authService = $authService;
        $this->authRepository = $authRepository;
    }

    public function execute(AuthRequest $request): AuthResponse
    {
        $auth = $this->authService->auth($request->getLogin(), $request->getPassword());
        $this->authRepository->save($auth);
        return new AuthResponse($auth);
    }
    */

    public function generateUserToken($userId)
    {
        $pems = AuthHelper::getUserPemIds($userId);
        return CryptoUtil::encodeJwt($userId, $pems);
    }
}
