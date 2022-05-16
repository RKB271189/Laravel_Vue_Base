<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\Create;
use App\Http\Requests\Product\Update;
use App\ORM_Model\Fld_Product\ProductInterface;
use Exception;

class ProductController extends Controller
{
    private $productRepository;
    public function __construct(ProductInterface $productInterface)
    {
        $this->productRepository = $productInterface;
    }
    public function get()
    {
        try {
            $products = $this->productRepository->Select();
            return response()->json($products, 200);
        } catch (Exception $ex) {
            $this->WriteGeneralException($ex);
            return response()->json($this->ExceptionResponse($ex), 500);
        }
    }
    public function getprimary($id)
    {
        try {
            $product = $this->productRepository->SearchOrFail($id);
            return response()->json($product, 200);
        } catch (Exception $ex) {
            $this->WriteGeneralException($ex);
            return response()->json($this->ExceptionResponse($ex), 500);
        }
    }
    public function delete($id)
    {
        try {
            $delete = $this->productRepository->Remove($id);
            if ($delete === 0)
                throw new Exception("Unable to delete");
            return response()->json("Product deleted successfully.", 200);
        } catch (Exception $ex) {
            $this->WriteGeneralException($ex);
            return response()->json($this->ExceptionResponse($ex), 500);
        }
    }
    public function create(Create $request)
    {

        $wantreturn = false;
        try {
            $params = $request->except('_method', '_token', 'id');
            $this->productRepository->Save($params, $wantreturn);
            return response()->json("Product saved successfully", 200);
        } catch (Exception $ex) {
            $this->WriteGeneralException($ex);
            return response()->json($this->ExceptionResponse($ex), 500);
        }
    }
    public function update(Update $request)
    {
        $isreturn = false;
        try {
            $id = $request->id;
            $params = $request->except('_method', '_token', 'id');
            $this->productRepository->Update($id, $params, $isreturn);
            return response()->json("Product updated successfully", 200);
        } catch (Exception $ex) {
            $this->WriteGeneralException($ex);
            return response()->json($this->ExceptionResponse($ex), 500);
        }
    }
    public function getrestore()
    {
        try {
            $product = $this->productRepository->GetRestore();
            return response()->json($product, 200);
        } catch (Exception $ex) {
            $this->WriteGeneralException($ex);
            return response()->json($this->ExceptionResponse($ex), 500);
        }
    }
    public function restore($id)
    {
        try {
            $this->productRepository->Restore($id);
            return response()->json("Product restored successfully", 200);
        } catch (Exception $ex) {
            $this->WriteGeneralException($ex);
            return response()->json($this->ExceptionResponse($ex), 500);
        }
    }
}
