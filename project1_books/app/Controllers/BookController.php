<?php

namespace App\Controllers;

use App\Models\BookModel;
use CodeIgniter\Controller;

class BookController extends BaseController
{
    protected $bookModel;

    public function __construct()
    {
        $this->bookModel = new BookModel();
    }

    public function index()
    {
        $data['books'] = $this->bookModel->orderBy('id', 'DESC')->findAll();
        $data['title'] = 'All Books';
        return view('books/index', $data);
    }

    public function create()
    {
        $data['title'] = 'Add New Book';
        return view('books/create', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'title' => 'required|min_length[3]|max_length[200]',
            'author' => 'required|min_length[2]|max_length[100]',
            'isbn' => 'required|min_length[10]|max_length[20]',
            'published_year' => 'required|numeric|min_length[4]|max_length[4]',
            'genre' => 'required',
            'price' => 'required|decimal'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $this->bookModel->save([
            'title' => $this->request->getPost('title'),
            'author' => $this->request->getPost('author'),
            'isbn' => $this->request->getPost('isbn'),
            'published_year' => $this->request->getPost('published_year'),
            'genre' => $this->request->getPost('genre'),
            'price' => $this->request->getPost('price'),
            'description' => $this->request->getPost('description')
        ]);

        return redirect()->to('/books')->with('success', 'Book added successfully!');
    }

    public function show($id)
    {
        $data['book'] = $this->bookModel->find($id);
        
        if (!$data['book']) {
            return redirect()->to('/books')->with('error', 'Book not found!');
        }
        
        $data['title'] = 'Book Details';
        return view('books/show', $data);
    }

    public function edit($id)
    {
        $data['book'] = $this->bookModel->find($id);
        
        if (!$data['book']) {
            return redirect()->to('/books')->with('error', 'Book not found!');
        }
        
        $data['title'] = 'Edit Book';
        return view('books/edit', $data);
    }

    public function update($id)
    {
        $validation = \Config\Services::validation();

        $rules = [
            'title' => 'required|min_length[3]|max_length[200]',
            'author' => 'required|min_length[2]|max_length[100]',
            'isbn' => 'required|min_length[10]|max_length[20]',
            'published_year' => 'required|numeric|min_length[4]|max_length[4]',
            'genre' => 'required',
            'price' => 'required|decimal'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $this->bookModel->update($id, [
            'title' => $this->request->getPost('title'),
            'author' => $this->request->getPost('author'),
            'isbn' => $this->request->getPost('isbn'),
            'published_year' => $this->request->getPost('published_year'),
            'genre' => $this->request->getPost('genre'),
            'price' => $this->request->getPost('price'),
            'description' => $this->request->getPost('description')
        ]);

        return redirect()->to('/books')->with('success', 'Book updated successfully!');
    }

    public function delete($id)
    {
        $book = $this->bookModel->find($id);
        
        if (!$book) {
            return redirect()->to('/books')->with('error', 'Book not found!');
        }

        $this->bookModel->delete($id);
        return redirect()->to('/books')->with('success', 'Book deleted successfully!');
    }
}
