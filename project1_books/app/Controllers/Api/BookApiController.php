<?php

namespace App\Controllers\Api;

use App\Models\BookModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class BookApiController extends ResourceController
{
    use ResponseTrait;

    protected $bookModel;
    protected $format = 'json';

    public function __construct()
    {
        $this->bookModel = new BookModel();
    }

    public function index()
    {
        $books = $this->bookModel->orderBy('id', 'DESC')->findAll();
        
        return $this->respond([
            'status' => 200,
            'message' => 'Books retrieved successfully',
            'data' => $books
        ]);
    }

    public function show($id = null)
    {
        $book = $this->bookModel->find($id);

        if (!$book) {
            return $this->failNotFound('Book not found with id ' . $id);
        }

        return $this->respond([
            'status' => 200,
            'message' => 'Book found',
            'data' => $book
        ]);
    }

    public function create()
    {
        $rules = [
            'title' => 'required|min_length[3]|max_length[200]',
            'author' => 'required|min_length[2]|max_length[100]',
            'isbn' => 'required|min_length[10]|max_length[20]',
            'published_year' => 'required|numeric',
            'genre' => 'required',
            'price' => 'required|decimal'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = [
            'title' => $this->request->getVar('title'),
            'author' => $this->request->getVar('author'),
            'isbn' => $this->request->getVar('isbn'),
            'published_year' => $this->request->getVar('published_year'),
            'genre' => $this->request->getVar('genre'),
            'price' => $this->request->getVar('price'),
            'description' => $this->request->getVar('description')
        ];

        $bookId = $this->bookModel->insert($data);

        return $this->respondCreated([
            'status' => 201,
            'message' => 'Book created successfully',
            'data' => $this->bookModel->find($bookId)
        ]);
    }

    public function update($id = null)
    {
        $book = $this->bookModel->find($id);

        if (!$book) {
            return $this->failNotFound('Book not found with id ' . $id);
        }

        $rules = [
            'title' => 'required|min_length[3]|max_length[200]',
            'author' => 'required|min_length[2]|max_length[100]',
            'isbn' => 'required|min_length[10]|max_length[20]',
            'published_year' => 'required|numeric',
            'genre' => 'required',
            'price' => 'required|decimal'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = [
            'title' => $this->request->getVar('title'),
            'author' => $this->request->getVar('author'),
            'isbn' => $this->request->getVar('isbn'),
            'published_year' => $this->request->getVar('published_year'),
            'genre' => $this->request->getVar('genre'),
            'price' => $this->request->getVar('price'),
            'description' => $this->request->getVar('description')
        ];

        $this->bookModel->update($id, $data);

        return $this->respond([
            'status' => 200,
            'message' => 'Book updated successfully',
            'data' => $this->bookModel->find($id)
        ]);
    }

    public function delete($id = null)
    {
        $book = $this->bookModel->find($id);

        if (!$book) {
            return $this->failNotFound('Book not found with id ' . $id);
        }

        $this->bookModel->delete($id);

        return $this->respondDeleted([
            'status' => 200,
            'message' => 'Book deleted successfully'
        ]);
    }
}
