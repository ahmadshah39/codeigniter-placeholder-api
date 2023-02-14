<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use \CodeIgniter\HTTP\ResponseInterface;

class CommentController extends ResourceController
{
    protected $modelName = 'App\Models\CommentModel';
    
    protected $format    = 'json';
    
    protected $resourceFields = ["id",'name','email','body','post_id'];
    
    protected $helpers = ['global'];

    protected $rules = [
        "create" => [
            'title' => "required",
            'url' => "required|valid_url",
            'thumbnail_url' => "required|valid_url",
            'album_id' => "required|int",
        ],
        "update" => [
            'title' => "required",
            'url' => "required|valid_url",
            'thumbnail_url' => "required|valid_url",
            'album_id' => "required|int",
        ],
        "patch" => [
            'url' => "if_exist|valid_url",
            'thumbnail_url' => "if_exist|valid_url",
            'album_id' => "if_exist|int",
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
        $post_id = $this->request->getVar('post_id') ? $this->request->getVar('post_id') : null;

        try {
            $photos = $this->model->select($this->resourceFields)->orderBy($sort_by, $sort);

            if($post_id){
                $photos = $photos->where('post_id', $post_id);
            }
            
            if($query){
                $photos = $photos->groupStart()
                                    ->where('id', $query)
                                    ->orLike('name', $query)
                                    ->orLike('body', $query)
                                    ->orLike('email', $query)
                                ->groupEnd();
            }
            
           $photos = $photos->paginate($limit, $page);

            if (!$photos) {
                throw \App\Exceptions\NotFoundException::forRecordNotFound();
            }
            return $this->respond($photos, 200);

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

            $photo = $this->model->select($this->resourceFields)->find($id);
            if (!$photo) {
                throw \App\Exceptions\NotFoundException::forRecordNotFound();
            }
            return $this->respond($photo, 200);

        } catch (\Throwable $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            return $this->respond(['error'=>$e->getMessage()], http_exception_code($e->getCode()));
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
            'message' => $id ? 'Photo created successfully' : "Something went wrong"
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
            'message' => $id ? 'Photo updated successfully' : "Something went wrong"
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
            'message' => $deleted ? 'Photo deleted successfully' : "Something went wrong"
        ], 200);
    }
}
