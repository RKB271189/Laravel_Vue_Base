<?php

namespace App\Usables_Extensions;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

trait WriteRead
{
    // Write Model Exceptions
    public function WriteModelException(Exception $ex)
    {
    }
    // Read Model Exceptions
    public function ReadModelException(Exception $ex)
    {
    }
    //Write General Exception
    public function WriteGeneralException(Exception $ex)
    {
        Log::channel('general_exception')->info("General Exception : " . $ex->getMessage() . ' On Line : ' . $ex->getLine());
    }
    //Read General Exception 
    public function ReadGeneralException(Exception $ex)
    {
    }
    public function StoreImage(string $path, $image, string &$error): bool
    {
        try {
            $isstored = Storage::disk('public')->put($path, $image);
            return $isstored;
        } catch (Exception $ex) {
            $error = $ex->getMessage();
            return false;
        }
    }
}
