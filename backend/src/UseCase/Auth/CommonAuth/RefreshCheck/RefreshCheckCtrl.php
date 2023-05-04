<?php

namespace Src\UseCase\Auth\CommonAuth\RefreshCheck;

use Illuminate\Http\Request;

class RefreshCheckCtrl {
    public function refreshCheck(Request $request) {
        return response()->json([]);
    }
}
