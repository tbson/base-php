<?php

namespace Src\UseCase\Config\Variable;

use Illuminate\Http\Request;
use Src\Controller;
use Src\Service\Account\UserService;

/**
 * Class VariableCtrl
 * @package Src\UseCase\Config\Variable\VariableCtrl
 */
class VariableCtrl extends Controller
{
    public function list(Request $request)
    {
        # dump($request->get("user"));
        $items = UserService::getAllUsers();
        return response()->json(["items" => $items]);
    }

    public function retrieve(int $id)
    {
        return response()->json(["key" => $id]);
    }
}