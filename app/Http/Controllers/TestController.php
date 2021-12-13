<?php

namespace App\Http\Controllers;

use App\Http\Requests\Test\Image;
use App\Jobs\SocketTest;
use App\ORM_Model\Fld_Event\EventInterface;
use App\ORM_Model\Fld_Product\ProductInterface;
use App\ORM_Model\Fld_User\UserInterface;
use App\Usables_Extensions\ImageStore;
use Exception;
use Illuminate\Http\Request;

class TestController extends Controller
{
    use ImageStore;
    private $userRepository;
    private $productRepository;
    private $eventRepository;
    public function __construct(UserInterface $userInterface, ProductInterface $productInterface, EventInterface $eventInterface)
    {
        $this->userRepository = $userInterface;
        $this->productRepository = $productInterface;
        $this->eventRepository = $eventInterface;
    }
    /**
     * Function to test google firebase notification
     */
    public function firebase()
    {
        $isfound = true;
        try {
            $userid = 2; //As an example           
            $this->eventRepository->notification('Hello World', $userid);
            return response()->json('Successfull', 200);
        } catch (Exception $ex) {
            $this->WriteGeneralException($ex);
            if (config('app.env') === 'local') { //set to local in env file to indentify the error
                return response()->json($ex->getMessage(), 500);
            } else {
                return response()->json('Server Error : Try again later.', 500);
            }
        }
    }
    /**
     * Function to test websocket
     */
    public function websocket()
    {
        try {
            SocketTest::dispatchAfterResponse(); //If not local add jobs delay accordingly
            /**
             * Necessary command for database as job driver
             * php artisan queue:table will create migration
             * php artisan migrate will create table for jobs
             */
            return response()->json('socket testing successfull', 200);
        } catch (Exception $ex) {
            $this->WriteGeneralException($ex);
            if (config('app.env') === 'local') { //set to local in env file to indentify the error
                return response()->json($ex->getMessage(), 500);
            } else {
                return response()->json('Server Error : Try again later.', 500);
            }
        }
    }
    /**
     * Function to save image {{Currently it is stored in public folder --- need to test for storage folder}}
     */
    public function saveimage(Image $request){
        try{
            $filename='';
            $error='';
            $store=$this->SaveImageFromWeb($request,$filename,$error);
            //Store file name to database
            if(!$store){
                throw new Exception("Web Image Store Exception : ".__METHOD__." ".$error);
            }
        }catch(Exception $ex){
            $this->WriteGeneralException($ex);
            if (config('app.env') === 'local') { //set to local in env file to indentify the error
                return response()->json($ex->getMessage(), 500);
            } else {
                return response()->json('Server Error : Try again later.', 500);
            }
        }
    }
}
