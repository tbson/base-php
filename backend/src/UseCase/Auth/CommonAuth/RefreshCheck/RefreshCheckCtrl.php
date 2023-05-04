<?php

namespace Src\UseCase\Auth\CommonAuth\RefreshCheck;

use Illuminate\Http\Request;
use Src\Util\ResUtil;

class RefreshCheckCtrl {
    public function refreshCheck(Request $request) {
        return ResUtil::res([]);
    }
}
