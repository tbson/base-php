<?php

namespace Src\UseCase\Config\Variable;

use Src\Controller;

class VariableCtrl extends Controller
{
    public function list()
    {
        return response()->json(["items" => ["welcome"]]);
    }

    public function detail(int $id)
    {
        return response()->json(["key" => $id]);
    }
}
