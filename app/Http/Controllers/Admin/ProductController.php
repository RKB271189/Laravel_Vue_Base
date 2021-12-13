<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\Create;
use App\Http\Requests\Product\Update;
use App\ORM_Model\Fld_Product\ProductInterface;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productRepository;
    public function __construct(ProductInterface $productInterface)
    {
        $this->productRepository = $productInterface;
    }
    public function get()
    {
        $isfound = true;
        try {
            $products = $this->productRepository->Select($isfound);
            if (!$isfound) {
                throw new Exception("Model Exception : " . __METHOD__ . " get/fetch exception");
            }
            return response()->json($products, 200);
        } catch (Exception $ex) {
            $this->WriteGeneralException($ex);
            if (config('app.env') === 'local') { //set to local in env file to indentify the error
                return response()->json($ex->getMessage(), 500);
            } else {
                return response()->json('Server Error : Try again later.', 500);
            }
        }
    }
    public function getprimary($id)
    {
        $isfound = true;
        try {
            $product = $this->productRepository->SearchOrFail($id, $isfound);
            if (!$isfound) {
                throw new Exception("Model Exception : " . __METHOD__ . " exception for id : " . $id);
            } else {
                return response()->json($product, 200);
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
    public function delete($id)
    {
        $isfound = true;
        try {
            $removecount = 0;
            $delete = $this->productRepository->Remove($id, $isfound, $removecount);
            if (!$delete && !$isfound && $removecount === 0) {
                throw new Exception("Model Exception : " . __METHOD__ . " exception for id : " . $id);
            } elseif ($removecount == 0) {
                throw new Exception("General Exception : " . __METHOD__ . " exception for id : " . $id);
            }
            return response()->json("Product deleted successfully.", 200);
        } catch (Exception $ex) {
            $this->WriteGeneralException($ex);
            if (config('app.env') === 'local') { //set to local in env file to indentify the error
                return response()->json($ex->getMessage(), 500);
            } else {
                return response()->json('Server Error : Try again later.', 500);
            }
        }
    }
    public function create(Create $request)
    {
        $issaved = true;
        $wantreturn = false;
        try {
            $params = $request->except('_method', '_token', 'id');
            $save = $this->productRepository->Save($params, $issaved, $wantreturn);
            if ($save === null && !$issaved || !$issaved) {
                throw new Exception("Model Exception : " . __METHOD__ . " exception  saving product");
            } else {
                return response()->json("Product saved successfully", 200);
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
    public function update(Update $request)
    {
        $issaved = true;
        $isreturn = false;
        try {
            $id = $request->id;
            $params = $request->except('_method', '_token', 'id');
            $update = $this->productRepository->Update($id, $params, $issaved, $isreturn);
            if (!$issaved) {
                throw new Exception("Model Exception : " . __METHOD__ . " exception for id : " . $id . " product update failed");
            } else {
                return response()->json("Product updated successfully", 200);
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
    public function getrestore()
    {
        $isfound = true;
        try {
            $product = $this->productRepository->GetRestore($isfound);
            if (!$isfound) {
                throw new Exception("Model Exception : " . __METHOD__ . " get/fetch deleted data exception");
            } else {
                return response()->json($product, 200);
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
    public function restore($id)
    {
        $isfound = true;
        try {
            $records = $this->productRepository->Restore($id, $isfound);
            if (!$isfound) {
                throw new Exception("Model Exception : " . __METHOD__ . " exception for id : " . $id);
            } else {
                return response()->json("Product restored successfully", 200);
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
