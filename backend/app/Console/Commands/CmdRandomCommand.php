<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Src\UseCase\Auth\CommonAuth\RefreshToken\RefreshTokenFlow;
use Src\Service\Account\AccountService;
use Src\Service\Account\UserService;

class CmdRandomCommand extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "app:cmd-random-command";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Command description";

    /**
     * Execute the console command.
     */
    public function handle() {
        $tokenSignature =
            "d7OxzPIBtTg9i6H14hn9Wih_WFbc7dKNjkNZnUT5nOpRF2-2NYRvEzgbaI64QKXF6d3T1e9yxEw-tL2wGBrrmqgsfvPohPhxf4506Nfzyi3KMhlwjr9nqThW5vsIoH0ICoso4ffmCmuTBNXCJTkImYb2GPI6hy8esIEOs9c6a5xey-fYIxx0TkF2WM3qgDG0s9x2A9xVmG8nrVZ9yy7fw5BX8UghYnRXL0U4iKbvZmYbiFngKNl1kssX6S4qvNCcPXBT591etnPuxfRvpxz1FB-UHR2l9w1RTin0LP1AX2I3J_b5pqyi_aN26A7nnhq2CnmrgMiRrtxsK1JNF6kXNdNCL5thmwkwNSeag2tZiGVlm_nqrETxFPjH2nF7-S-XGGKbJO528YIvPFvxvoMzR-PCv7qVPqBp-7hJwRNuvx89duOtsXr2CaFlUZ-aIkSXC7PpLQfLcofy2nBlgFWgpj2UP401BgdGb2fhsDwpB-DOlW57IRfItSPLfqdKnkwr";
        $flow = new RefreshTokenFlow(new AccountService(), new UserService());
        $result = $flow->refresh($tokenSignature);
        dump($result);
    }
}
