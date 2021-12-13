<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ORM_Model\Fld_User\UserInterface;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepository;
    public function __construct(UserInterface $userInterface)
    {
        $this->userRepository = $userInterface;
    }
    public function get()
    {
        $isfound = true;
        try {
            $users = $this->userRepository->Select($isfound);
            if (!$isfound) {
                throw new Exception("Model Exception : " . __METHOD__ . " get/fetch exception");
            } else {
                return response()->json($users, 200);
            }
        } catch (Exception $ex) {
            $this->WriteGeneralException($ex);
            if (config('app.env') === 'local') { //set to local in env file to indentify the error
                return response()->json($ex->getMessage(), 500);
            } else {
                return response()->json('Server Error : Try again later.', 500);
            }
        }
    }
}
