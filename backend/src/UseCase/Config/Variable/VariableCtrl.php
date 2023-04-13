<?php

namespace Src\UseCase\Config\Variable;

use Src\Controller;
use Src\Service\Account\UserService;

class VariableCtrl extends Controller
{
    public function list()
    {
        $items = UserService::getAllUsers();
        return response()->json(["items" => $items]);
    }

    public function retrieve(int $id)
    {
        return response()->json(["key" => $id]);
    }
}
