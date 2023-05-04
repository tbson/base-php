<?php

namespace Src\UseCase\Config\Variable\Crud;

use Illuminate\Http\Request;
use Src\Util\ResUtil;
use Src\Controller;
use Src\Service\Account\UserService;

/**
 * Class CrudVariableCtrl
 * @package Src\UseCase\Config\Variable\CrudVariableCtrl
 */
class CrudVariableCtrl extends Controller {
    public function list(Request $request) {
        # dump($request->get("user"));
        return ResUtil::res(["items" => []]);
    }

    public function retrieve(int $id) {
        return ResUtil::res(["key" => $id]);
    }
}
