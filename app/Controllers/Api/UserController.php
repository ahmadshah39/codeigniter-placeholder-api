<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class UserController extends ResourceController
{
    protected $modelName = 'App\Models\UserModel';
    
    protected $format    = 'json';
    protected $rules = [
        "create" => [
                    'user_name' => "required|is_unique[users.user_name]",
                    'email' => "required|is_unique[users.email]",
                    'first_name' => 'required|alpha_numeric_space',
                    'last_name' => 'required|alpha_numeric_space',
                    'password'  => 'required',
                    'confirm_password'  => 'required|matches[password]',
                ]
    ];

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        try {
            $users = $this->model->select(["user_name", 'first_name', 'last_name', 'email'])->findAll();
            if (!$users) {
                throw \App\Exceptions\NotFoundException::forRecordNotFound();
            }
            return $this->respond($users, 200);

        } catch (\Exception $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            return $this->respond(['error'=>$e->getMessage()], $e->getCode());
        }
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        try {

            $user = $this->model->find($id);
            if (!$user) {
                throw \App\Exceptions\NotFoundException::forRecordNotFound();
            }
            return $this->respond($user, 200);

        } catch (\Exception $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            return $this->respond(['error'=>$e->getMessage()], $e->getCode());
        }
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        try {
            if (!$this->validate($this->rules['create'])) {
                return $this->respond(['error'=> $this->validator->getErrors()], 403);
            }

           $id =  $this->model->insert((array) $this->request->getJson());
           return $this->respond($id, 200);
        } catch (\Throwable $th) {
            
        }
        
        // var_dump((array) $this->request->getJson());

    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }
}
