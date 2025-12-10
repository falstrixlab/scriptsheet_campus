<?php

namespace App\Controllers\Api;

defined('APPPATH') OR exit('No direct script access allowed');

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Crud;

class Profile extends ResourceController
{
    protected $modelName = Crud::class;
    protected $format = 'json';
    protected $crud;

    public function __construct()
    {
        parent::__construct();
        $this->crud = new Crud();
    }

    /**
     * Get all users
     * GET /api/profile
     */
    public function index()
    {
        try {
            $users = $this->crud->readData('*', 'user');
            
            if ($users) {
                return $this->respond($users, 200);
            } else {
                return $this->respond(['message' => 'No users found'], 404);
            }
        } catch (\Exception $e) {
            return $this->respond(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Get single user by ID
     * GET /api/profile/{id}
     */
    public function show($id = null)
    {
        try {
            if (!$id) {
                return $this->respond(['error' => 'User ID is required'], 400);
            }

            $user = $this->crud->readData('*', 'user', ['user_id' => $id]);
            
            if ($user) {
                return $this->respond($user[0] ?? $user, 200);
            } else {
                return $this->respond(['message' => 'User not found'], 404);
            }
        } catch (\Exception $e) {
            return $this->respond(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Get all users (alias for index)
     * GET /api/profile/all
     */
    public function all()
    {
        return $this->index();
    }

    /**
     * Create a new user
     * POST /api/profile
     */
    public function create()
    {
        try {
            $request = $this->request->getJSON();

            // Validate required fields
            if (!$request || !isset($request->user_name) || !isset($request->user_pwd)) {
                return $this->respond(['error' => 'user_name and user_pwd are required'], 400);
            }

            $data = [
                'user_fullname'  => $request->user_fullname ?? '',
                'user_name'      => $request->user_name,
                'user_pwd'       => md5($request->user_pwd),
                'user_akses'     => $request->user_akses ?? 'user',
                'user_status'    => $request->user_status ?? 1,
                'user_created'   => date('Y-m-d H:i:s'),
            ];

            // Add to database
            $result = $this->crud->createData('user', $data);

            if ($result === false || (is_array($result) && isset($result['message']))) {
                return $this->respond(['error' => 'Failed to create user', 'details' => $result], 400);
            }

            return $this->respond(['message' => 'User created successfully', 'data' => $data], 201);
        } catch (\Exception $e) {
            return $this->respond(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update a user
     * PUT /api/profile/{id}
     */
    public function update($id = null)
    {
        try {
            if (!$id) {
                return $this->respond(['error' => 'User ID is required'], 400);
            }

            // Check if user exists
            $existing = $this->crud->readData('*', 'user', ['user_id' => $id]);
            if (!$existing) {
                return $this->respond(['error' => 'User not found'], 404);
            }

            $request = $this->request->getJSON();
            
            $data = [];
            if (isset($request->user_fullname)) {
                $data['user_fullname'] = $request->user_fullname;
            }
            if (isset($request->user_name)) {
                $data['user_name'] = $request->user_name;
            }
            if (isset($request->user_pwd)) {
                $data['user_pwd'] = md5($request->user_pwd);
            }
            if (isset($request->user_akses)) {
                $data['user_akses'] = $request->user_akses;
            }
            if (isset($request->user_status)) {
                $data['user_status'] = $request->user_status;
            }

            if (empty($data)) {
                return $this->respond(['error' => 'No fields to update'], 400);
            }

            $result = $this->crud->updateData('user', $data, ['user_id' => $id]);

            if ($result === false || (is_array($result) && isset($result['message']))) {
                return $this->respond(['error' => 'Failed to update user', 'details' => $result], 400);
            }

            return $this->respond(['message' => 'User updated successfully', 'data' => $data], 200);
        } catch (\Exception $e) {
            return $this->respond(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Delete a user
     * DELETE /api/profile/{id}
     */
    public function delete($id = null)
    {
        try {
            if (!$id) {
                return $this->respond(['error' => 'User ID is required'], 400);
            }

            // Check if user exists
            $existing = $this->crud->readData('*', 'user', ['user_id' => $id]);
            if (!$existing) {
                return $this->respond(['error' => 'User not found'], 404);
            }

            $result = $this->crud->deleteData('user', ['user_id' => $id]);

            if ($result === false || (is_array($result) && isset($result['message']))) {
                return $this->respond(['error' => 'Failed to delete user', 'details' => $result], 400);
            }

            return $this->respond(['message' => 'User deleted successfully'], 200);
        } catch (\Exception $e) {
            return $this->respond(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Search users by field
     * GET /api/profile/search/{field}/{value}
     */
    public function search($field = null, $value = null)
    {
        try {
            if (!$field || !$value) {
                return $this->respond(['error' => 'Field and value are required'], 400);
            }

            $users = $this->crud->readData('*', 'user', [$field => $value]);

            if ($users) {
                return $this->respond($users, 200);
            } else {
                return $this->respond(['message' => 'No users found matching criteria'], 404);
            }
        } catch (\Exception $e) {
            return $this->respond(['error' => $e->getMessage()], 500);
        }
    }
}
