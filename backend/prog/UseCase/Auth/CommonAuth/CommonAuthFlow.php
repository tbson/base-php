<?php

namespace Prog\UseCase\Auth\CommonAuth;

use Prog\UseCase\Auth\AuthHelper;
use Prog\Util\CryptoUtil;

/**
 * Class CommonAuthFlow
 * @package Prog\UseCase\Auth\CommonAuth\CommonAuthFlow
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
