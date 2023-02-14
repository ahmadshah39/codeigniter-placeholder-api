<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use \CodeIgniter\HTTP\ResponseInterface;

class UserController extends ResourceController
{
    protected $modelName = 'App\Models\UserModel';
    
    protected $format    = 'json';

    protected $resourceFields = ["id", "user_name", 'first_name', 'last_name', 'email'];

    protected $helpers = ['global'];

    protected $rules = [
        "create" => [
                    'user_name' => "required|is_unique[users.user_name]",
                    'email' => "required|is_unique[users.email]",
                    'first_name' => 'required|alpha_numeric_space',
                    'last_name' => 'required|alpha_numeric_space',
                    'password'  => 'required',
                    'confirm_password'  => 'required|matches[password]',
        ],
        "update" => [
                    'user_name' => "required|is_unique[users.user_name,id,{id}]",
                    'email' => "required|is_unique[users.email,id,{id}]",
                    'first_name' => 'required|alpha_numeric_space',
                    'last_name' => 'required|alpha_numeric_space',
                    'password'  => 'required',
                    'confirm_password'  => 'required|matches[password]',
        ],
        "patch" => [
                    'user_name' => "is_unique[users.user_name,id,{id}]",
                    'email' => "is_unique[users.email,id,{id}]",
                    'first_name' => 'if_exist|alpha_numeric_space',
                    'last_name' => 'if_exist|alpha_numeric_space',
        ],
    ];

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index():ResponseInterface
    {

        $sort = $this->request->getVar('sort') == ('DESC'|'desc') ? 'DESC' : 'ASC';
        $sort_by = in_array($this->request->getVar('sort_by'), $this->resourceFields) ? $this->request->getVar('sort_by') : 'id';
        $query = $this->request->getVar('query') ? $this->request->getVar('query') : null;
        $limit = $this->request->getVar('limit') ? $this->request->getVar('limit') : 100;
        $page = $this->request->getVar('page') ? $this->request->getVar('page') : 100;

        try {
            $users = $this->model->select($this->resourceFields)->orderBy($sort_by, $sort);

            if($query){
                $users = $users->like('user_name', $query)
                               ->orLike('first_name', $query)
                               ->orLike('last_name', $query)
                               ->orLike('email', $query);
            }
            
           $users = $users->paginate($limit, $page);

            if (!$users) {
                throw \App\Exceptions\NotFoundException::forRecordNotFound('No users found...');
            }
            return $this->respond($users, 200);

        } catch (\Throwable $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            return $this->respond(['error'=>$e->getMessage()], http_exception_code($e->getCode()));
        }
    }


    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null):ResponseInterface
    {
        try {

            $user = $this->model->select($this->resourceFields)->find($id);
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
    public function create():ResponseInterface
    {
        if (!$this->validate($this->rules['create'])) {
            return $this->respond(['error'=> $this->validator->getErrors()], 403);
        }

        $id = $this->model->insert((array) $this->request->getJson(), true);

        return $this->respond([
            'status' => $id,
            'message' => $id ? 'User created successfully' : "Something went wrong"
        ], 200);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null):ResponseInterface
    {
        $request_method = $this->request->is('patch') ? 'patch' :  'update' ;

        if($id == null){
            return $this->respond([
                'status' => 0,
                'message' => "Invalid request..."
            ], 403);
        }

        if (!$this->validate($this->rules[$request_method])) {
            return $this->respond(['error'=> $this->validator->getErrors()], 403);
        }

        $id = $this->model->update($id, (array) $this->request->getJson(), true);

        return $this->respond([
            'status' => $id,
            'message' => $id ? 'User updated successfully' : "Something went wrong"
        ], 200);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null):ResponseInterface
    {
        if($id == null){
            return $this->respond([
                'status' => 0,
                'message' => "Invalid request..."
            ], 403);
        }

        $deleted = $this->model->delete($id);

        return $this->respond([
            'status' => $deleted,
            'message' => $deleted ? 'User deleted successfully' : "Something went wrong"
        ], 200);
    }
}
