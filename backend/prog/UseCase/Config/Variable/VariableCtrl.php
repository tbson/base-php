<?php

namespace Prog\UseCase\Config\Variable;

use Prog\Controller;
use Prog\Srv\Account\UserSrv;

class VariableCtrl extends Controller
{
    public function list()
    {
        $items = UserSrv::getAllUsers();
        return response()->json(["items" => $items]);
    }

    public function retrieve(int $id)
    {
        return response()->json(["key" => $id]);
    }
}
