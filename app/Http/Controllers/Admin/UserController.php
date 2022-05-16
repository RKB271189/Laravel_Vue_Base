<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ORM_Model\Fld_User\UserInterface;
use Exception;

class UserController extends Controller
{
    private $userRepository;
    public function __construct(UserInterface $userInterface)
    {
        $this->userRepository = $userInterface;
    }
    public function get()
    {
        try {
            $users = $this->userRepository->Select();
            return response()->json($users, 200);
        } catch (Exception $ex) {
            $this->WriteGeneralException($ex);
            return response()->json($this->ExceptionResponse($ex), 500);
        }
    }
}
