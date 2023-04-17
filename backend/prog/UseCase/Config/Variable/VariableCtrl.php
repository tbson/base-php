<?php

namespace Prog\UseCase\Config\Variable;

use Illuminate\Http\Request;
use Prog\Controller;
use Prog\Srv\Account\UserSrv;

/**
 * Class VariableCtrl
 * @package Prog\UseCase\Config\Variable\VariableCtrl
 */
class VariableCtrl extends Controller
{
    public function list(Request $request)
    {
        # dump($request->get("user"));
        $items = UserSrv::getAllUsers();
        return response()->json(["items" => $items]);
    }

    public function retrieve(int $id)
    {
        return response()->json(["key" => $id]);
    }
}
