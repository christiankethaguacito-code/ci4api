<?php

namespace App\Controllers\Api;

use App\Models\EmployeeModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class EmployeeApiController extends ResourceController
{
    use ResponseTrait;

    protected $employeeModel;
    protected $format = 'json';

    public function __construct()
    {
        $this->employeeModel = new EmployeeModel();
    }

    public function index()
    {
        $employees = $this->employeeModel->orderBy('id', 'DESC')->findAll();
        
        return $this->respond([
            'status' => 200,
            'message' => 'Employees retrieved',
            'total' => count($employees),
            'data' => $employees
        ]);
    }

    public function show($id = null)
    {
        $employee = $this->employeeModel->find($id);

        if (!$employee) {
            return $this->failNotFound('Employee with id ' . $id . ' not found');
        }

        return $this->respond([
            'status' => 200,
            'message' => 'Employee found',
            'data' => $employee
        ]);
    }

    public function create()
    {
        $rules = [
            'first_name' => 'required|min_length[2]',
            'last_name' => 'required|min_length[2]',
            'email' => 'required|valid_email',
            'phone' => 'required',
            'department' => 'required',
            'position' => 'required',
            'salary' => 'required|numeric',
            'hire_date' => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = [
            'first_name' => $this->request->getVar('first_name'),
            'last_name' => $this->request->getVar('last_name'),
            'email' => $this->request->getVar('email'),
            'phone' => $this->request->getVar('phone'),
            'department' => $this->request->getVar('department'),
            'position' => $this->request->getVar('position'),
            'salary' => $this->request->getVar('salary'),
            'hire_date' => $this->request->getVar('hire_date'),
            'address' => $this->request->getVar('address'),
            'status' => $this->request->getVar('status') ?? 'active'
        ];

        $id = $this->employeeModel->insert($data);

        return $this->respondCreated([
            'status' => 201,
            'message' => 'Employee created',
            'data' => $this->employeeModel->find($id)
        ]);
    }

    public function update($id = null)
    {
        $employee = $this->employeeModel->find($id);

        if (!$employee) {
            return $this->failNotFound('Employee not found');
        }

        $rules = [
            'first_name' => 'required|min_length[2]',
            'last_name' => 'required|min_length[2]',
            'email' => 'required|valid_email',
            'department' => 'required',
            'position' => 'required',
            'salary' => 'required|numeric'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = [
            'first_name' => $this->request->getVar('first_name'),
            'last_name' => $this->request->getVar('last_name'),
            'email' => $this->request->getVar('email'),
            'phone' => $this->request->getVar('phone'),
            'department' => $this->request->getVar('department'),
            'position' => $this->request->getVar('position'),
            'salary' => $this->request->getVar('salary'),
            'hire_date' => $this->request->getVar('hire_date'),
            'address' => $this->request->getVar('address'),
            'status' => $this->request->getVar('status')
        ];

        $this->employeeModel->update($id, $data);

        return $this->respond([
            'status' => 200,
            'message' => 'Employee updated',
            'data' => $this->employeeModel->find($id)
        ]);
    }

    public function delete($id = null)
    {
        $employee = $this->employeeModel->find($id);

        if (!$employee) {
            return $this->failNotFound('Employee not found');
        }

        $this->employeeModel->delete($id);

        return $this->respondDeleted([
            'status' => 200,
            'message' => 'Employee deleted'
        ]);
    }
}
