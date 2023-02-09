<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class TodoController extends ResourceController
{
    protected $modelName = 'App\Models\TodoModel';

    protected $format    = 'json';

    protected $sortable = ['id', 'title', 'completed', 'user_id'];

    protected $filterable = ["completed"];

    protected $rules = [
        "create" => [
            'title' => "required",
            'completed' => "required|in_list[0,1]",
            'user_id' => "required",
        ],
        "update" => [
            'title' => "required",
            'completed' => "required|in_list[0,1]",
            'user_id' => "required",
        ],
        "patch" => [
            'completed' => "if_exist|in_list[0,1]",
        ],
    ];

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $sort = $this->request->getVar('sort') == ('DESC'|'desc') ? 'DESC' : 'ASC';
        $sort_by = in_array($this->request->getVar('sort_by'), $this->sortable) ? $this->request->getVar('sort_by') : 'id';
        $query = $this->request->getVar('query') ? $this->request->getVar('query') : null;
        $limit = $this->request->getVar('limit') ? $this->request->getVar('limit') : 10;
        $page = $this->request->getVar('page') ? $this->request->getVar('page') : 10;

        try {
            $todos = $this->model->select(['id', 'title', 'completed', 'user_id'])->orderBy($sort_by, $sort);

            if($query){
                $todos = $todos->like('title', $query);
            }
            
           $todos = $todos->paginate($limit, $page);

            if (!$todos) {
                throw \App\Exceptions\NotFoundException::forRecordNotFound();
            }
            return $this->respond($todos, 200);

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

            $todo = $this->model->find($id);
            if (!$todo) {
                throw \App\Exceptions\NotFoundException::forRecordNotFound();
            }
            return $this->respond($todo, 200);

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
        if (!$this->validate($this->rules['create'])) {
            return $this->respond(['error'=> $this->validator->getErrors()], 403);
        }

        $id = $this->model->insert((array) $this->request->getJson(), true);

        return $this->respond([
            'status' => $id,
            'message' => $id ? 'Todo created successfully' : "Something went wrong"
        ], 200);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
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
            'message' => $id ? 'Todo updated successfully' : "Something went wrong"
        ], 200);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
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
            'message' => $deleted ? 'Todo deleted successfully' : "Something went wrong"
        ], 200);
    }
}
