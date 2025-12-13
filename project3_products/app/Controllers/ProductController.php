<?php

namespace App\Controllers;

use App\Models\ProductModel;
use CodeIgniter\Controller;

class ProductController extends BaseController
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $data['products'] = $this->productModel->orderBy('id', 'DESC')->findAll();
        $data['title'] = 'Product Inventory';
        return view('products/index', $data);
    }

    public function add()
    {
        $data['title'] = 'Add Product';
        return view('products/add', $data);
    }

    public function save()
    {
        $rules = [
            'name' => 'required|min_length[3]|max_length[150]',
            'sku' => 'required|min_length[3]|max_length[30]',
            'category' => 'required',
            'price' => 'required|decimal',
            'quantity' => 'required|integer',
            'supplier' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->productModel->save([
            'name' => $this->request->getPost('name'),
            'sku' => $this->request->getPost('sku'),
            'category' => $this->request->getPost('category'),
            'price' => $this->request->getPost('price'),
            'cost_price' => $this->request->getPost('cost_price'),
            'quantity' => $this->request->getPost('quantity'),
            'min_stock' => $this->request->getPost('min_stock') ?? 10,
            'supplier' => $this->request->getPost('supplier'),
            'description' => $this->request->getPost('description'),
            'status' => $this->request->getPost('status') ?? 'in_stock'
        ]);

        return redirect()->to('/products')->with('success', 'Product added to inventory!');
    }

    public function details($id)
    {
        $data['product'] = $this->productModel->find($id);
        
        if (!$data['product']) {
            return redirect()->to('/products')->with('error', 'Product not found.');
        }
        
        $data['title'] = 'Product Details';
        return view('products/details', $data);
    }

    public function edit($id)
    {
        $data['product'] = $this->productModel->find($id);
        
        if (!$data['product']) {
            return redirect()->to('/products')->with('error', 'Product not found.');
        }
        
        $data['title'] = 'Edit Product';
        return view('products/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'name' => 'required|min_length[3]|max_length[150]',
            'sku' => 'required|min_length[3]|max_length[30]',
            'category' => 'required',
            'price' => 'required|decimal',
            'quantity' => 'required|integer',
            'supplier' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->productModel->update($id, [
            'name' => $this->request->getPost('name'),
            'sku' => $this->request->getPost('sku'),
            'category' => $this->request->getPost('category'),
            'price' => $this->request->getPost('price'),
            'cost_price' => $this->request->getPost('cost_price'),
            'quantity' => $this->request->getPost('quantity'),
            'min_stock' => $this->request->getPost('min_stock'),
            'supplier' => $this->request->getPost('supplier'),
            'description' => $this->request->getPost('description'),
            'status' => $this->request->getPost('status')
        ]);

        return redirect()->to('/products')->with('success', 'Product updated successfully!');
    }

    public function remove($id)
    {
        $product = $this->productModel->find($id);
        
        if (!$product) {
            return redirect()->to('/products')->with('error', 'Product not found.');
        }

        $this->productModel->delete($id);
        return redirect()->to('/products')->with('success', 'Product removed from inventory!');
    }
}
