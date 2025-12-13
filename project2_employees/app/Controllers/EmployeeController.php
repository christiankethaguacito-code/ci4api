<?php

namespace App\Controllers;

use App\Models\EmployeeModel;
use CodeIgniter\Controller;

class EmployeeController extends BaseController
{
    protected $employeeModel;

    public function __construct()
    {
        $this->employeeModel = new EmployeeModel();
    }

    public function index()
    {
        $data['employees'] = $this->employeeModel->orderBy('id', 'DESC')->findAll();
        $data['title'] = 'Employee Directory';
        return view('employees/index', $data);
    }

    public function create()
    {
        $data['title'] = 'Add Employee';
        return view('employees/create', $data);
    }

    public function store()
    {
        $rules = [
            'first_name' => 'required|min_length[2]|max_length[50]',
            'last_name' => 'required|min_length[2]|max_length[50]',
            'email' => 'required|valid_email',
            'phone' => 'required|min_length[10]',
            'department' => 'required',
            'position' => 'required',
            'salary' => 'required|numeric',
            'hire_date' => 'required|valid_date'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->employeeModel->save([
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'department' => $this->request->getPost('department'),
            'position' => $this->request->getPost('position'),
            'salary' => $this->request->getPost('salary'),
            'hire_date' => $this->request->getPost('hire_date'),
            'address' => $this->request->getPost('address'),
            'status' => $this->request->getPost('status') ?? 'active'
        ]);

        return redirect()->to('/employees')->with('success', 'Employee added successfully!');
    }

    public function view($id)
    {
        $data['employee'] = $this->employeeModel->find($id);
        
        if (!$data['employee']) {
            return redirect()->to('/employees')->with('error', 'Employee not found.');
        }
        
        $data['title'] = 'Employee Details';
        return view('employees/view', $data);
    }

    public function edit($id)
    {
        $data['employee'] = $this->employeeModel->find($id);
        
        if (!$data['employee']) {
            return redirect()->to('/employees')->with('error', 'Employee not found.');
        }
        
        $data['title'] = 'Edit Employee';
        return view('employees/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'first_name' => 'required|min_length[2]|max_length[50]',
            'last_name' => 'required|min_length[2]|max_length[50]',
            'email' => 'required|valid_email',
            'phone' => 'required|min_length[10]',
            'department' => 'required',
            'position' => 'required',
            'salary' => 'required|numeric',
            'hire_date' => 'required|valid_date'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->employeeModel->update($id, [
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'department' => $this->request->getPost('department'),
            'position' => $this->request->getPost('position'),
            'salary' => $this->request->getPost('salary'),
            'hire_date' => $this->request->getPost('hire_date'),
            'address' => $this->request->getPost('address'),
            'status' => $this->request->getPost('status')
        ]);

        return redirect()->to('/employees')->with('success', 'Employee updated!');
    }

    public function delete($id)
    {
        $employee = $this->employeeModel->find($id);
        
        if (!$employee) {
            return redirect()->to('/employees')->with('error', 'Employee not found.');
        }

        $this->employeeModel->delete($id);
        return redirect()->to('/employees')->with('success', 'Employee removed!');
    }
}
