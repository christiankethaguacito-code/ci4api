<?php

namespace App\Controllers\Api;

use App\Models\ProductModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class ProductApiController extends ResourceController
{
    use ResponseTrait;

    protected $productModel;
    protected $format = 'json';

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $products = $this->productModel->orderBy('id', 'DESC')->findAll();
        
        return $this->respond([
            'status' => 200,
            'message' => 'Products fetched',
            'count' => count($products),
            'data' => $products
        ]);
    }

    public function show($id = null)
    {
        $product = $this->productModel->find($id);

        if (!$product) {
            return $this->failNotFound('Product #' . $id . ' not found');
        }

        return $this->respond([
            'status' => 200,
            'message' => 'Product found',
            'data' => $product
        ]);
    }

    public function create()
    {
        $rules = [
            'name' => 'required|min_length[3]',
            'sku' => 'required',
            'category' => 'required',
            'price' => 'required|decimal',
            'quantity' => 'required|integer',
            'supplier' => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getVar('name'),
            'sku' => $this->request->getVar('sku'),
            'category' => $this->request->getVar('category'),
            'price' => $this->request->getVar('price'),
            'cost_price' => $this->request->getVar('cost_price'),
            'quantity' => $this->request->getVar('quantity'),
            'min_stock' => $this->request->getVar('min_stock') ?? 10,
            'supplier' => $this->request->getVar('supplier'),
            'description' => $this->request->getVar('description'),
            'status' => $this->request->getVar('status') ?? 'in_stock'
        ];

        $id = $this->productModel->insert($data);

        return $this->respondCreated([
            'status' => 201,
            'message' => 'Product added',
            'data' => $this->productModel->find($id)
        ]);
    }

    public function update($id = null)
    {
        $product = $this->productModel->find($id);

        if (!$product) {
            return $this->failNotFound('Product not found');
        }

        $rules = [
            'name' => 'required|min_length[3]',
            'sku' => 'required',
            'category' => 'required',
            'price' => 'required|decimal',
            'quantity' => 'required|integer'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getVar('name'),
            'sku' => $this->request->getVar('sku'),
            'category' => $this->request->getVar('category'),
            'price' => $this->request->getVar('price'),
            'cost_price' => $this->request->getVar('cost_price'),
            'quantity' => $this->request->getVar('quantity'),
            'min_stock' => $this->request->getVar('min_stock'),
            'supplier' => $this->request->getVar('supplier'),
            'description' => $this->request->getVar('description'),
            'status' => $this->request->getVar('status')
        ];

        $this->productModel->update($id, $data);

        return $this->respond([
            'status' => 200,
            'message' => 'Product updated',
            'data' => $this->productModel->find($id)
        ]);
    }

    public function delete($id = null)
    {
        $product = $this->productModel->find($id);

        if (!$product) {
            return $this->failNotFound('Product not found');
        }

        $this->productModel->delete($id);

        return $this->respondDeleted([
            'status' => 200,
            'message' => 'Product removed'
        ]);
    }
}
