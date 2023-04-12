<?php

namespace Src\UseCase\Config\Variable;

use Src\Controller;
Use Src\Util\LogUtil;

class VariableCtrl extends Controller
{
    public function list()
    {
        return response()->json(["items" => ["welcome"]]);
    }

    public function detail(int $id)
    {
        $data = ["hello" => "world"];
        LogUtil::log($data);
        return response()->json(["key" => $id]);
    }
}
