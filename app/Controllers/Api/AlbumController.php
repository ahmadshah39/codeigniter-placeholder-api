<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class AlbumController extends ResourceController
{
    protected $modelName = 'App\Models\AlbumModel';
    
    protected $format    = 'json';

    protected $sortable = ["id","title"];

    protected $rules = [
        "create" => [
            'title' => 'required',
            'user_id' => 'required',
        ],
        "update" => [
            'title' => 'required',
            'user_id' => 'required',
        ],
        "patch" => [
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
        $limit = $this->request->getVar('limit') ? $this->request->getVar('limit') : 50;
        $page = $this->request->getVar('page') ? $this->request->getVar('page') : 50;

        try {
            $albums = $this->model->select(["id", "title", "user_id"])->orderBy($sort_by, $sort);

            if($query){
                $albums = $albums->where('id', $query)
                               ->orWhere('user_id', $query)
                               ->orLike('title', $query);
            }
            
           $albums = $albums->paginate($limit, $page);

            if (!$albums) {
                throw \App\Exceptions\NotFoundException::forRecordNotFound();
            }
            return $this->respond($albums, 200);

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

            $album = $this->model->find($id);
            if (!$album) {
                throw \App\Exceptions\NotFoundException::forRecordNotFound();
            }
            return $this->respond($album, 200);

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
            'message' => $id ? 'Album created successfully' : "Something went wrong"
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
            'message' => $id ? 'Album updated successfully' : "Something went wrong"
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
            'message' => $deleted ? 'Album deleted successfully' : "Something went wrong"
        ], 200);
    }
}
