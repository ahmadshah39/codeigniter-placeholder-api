<?php


$routes->resource('users', ['controller'=>'UserController', 'except' => 'new,edit']);

$routes->resource('posts', ['controller'=>'PostController', 'except' => 'new,edit']);

$routes->resource('albums', ['controller'=>'AlbumController', 'except' => 'new,edit']);

$routes->resource('todos', ['controller'=>'TodoController', 'except' => 'new,edit']);

$routes->resource('photos', ['controller'=>'PhotoController', 'except' => 'new,edit']);

$routes->resource('comments', ['controller'=>'CommentController', 'except' => 'new,edit']);

