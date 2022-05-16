<?php

namespace App\Usables_Extensions;

use Exception;

trait ExtraMethod
{
    public function ExceptionResponse(Exception $ex)
    {
        if (config('app.env') === 'local') {
            return $ex->getMessage();
        } else {
            return 'Server Error : Try again later.';
        }
    }
}
