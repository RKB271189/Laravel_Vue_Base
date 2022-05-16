<?php

namespace App\Http\Controllers;

use App\Usables_Extensions\ExtraMethod;
use App\Usables_Extensions\WriteRead;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, WriteRead, ExtraMethod;
}
