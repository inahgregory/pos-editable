<?php

namespace App\Controllers;

use App\Models\CustomerModel;

class Customers extends BaseController
{
    protected $customerModel;

    public function __construct()
    {
        $this->customerModel = new CustomerModel();
    }

    public function index()
    {
        return view('templates/header', ['title' => 'Customers'])
            . view('customers/index', [
                'customers' => $this->customerModel->getAllCustomers()
            ])
            . view('templates/footer');
    }

    public function new()
    {
        return view('templates/header', ['title' => 'New Customer'])
            . view('customers/form', [
                'errors' => [],
                'customer' => null,
                'action' => site_url('/customers/create')
            ])
            . view('templates/footer');
    }

    public function create()
    {
        $rules = [
            'full_name' => 'required',
            'email' => 'required|valid_email'
        ];

        if (! $this->validate($rules)) {
            return view('templates/header', ['title' => 'New Customer'])
                . view('customers/form', [
                    'errors' => $this->validator->getErrors(),
                    'customer' => null,
                    'action' => site_url('/customers/create')
                ])
                . view('templates/footer');
        }

        $this->customerModel->insert([
            'full_name' => $this->request->getPost('full_name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address'),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/customers');
    }

    public function edit($id)
    {
        $customer = $this->customerModel->find($id);

        if (! $customer) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Customer not found');
        }

        return view('templates/header', ['title' => 'Edit Customer'])
            . view('customers/form', [
                'errors' => [],
                'customer' => $customer,
                'action' => site_url('/customers/update/' . $id)
            ])
            . view('templates/footer');
    }

    public function update($id)
    {
        $customer = $this->customerModel->find($id);

        if (! $customer) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Customer not found');
        }

        $rules = [
            'full_name' => 'required',
            'email' => 'required|valid_email'
        ];

        if (! $this->validate($rules)) {
            return view('templates/header', ['title' => 'Edit Customer'])
                . view('customers/form', [
                    'errors' => $this->validator->getErrors(),
                    'customer' => $customer,
                    'action' => site_url('/customers/update/' . $id)
                ])
                . view('templates/footer');
        }

        $this->customerModel->update($id, [
            'full_name' => $this->request->getPost('full_name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address')
        ]);

        return redirect()->to('/customers');
    }
}