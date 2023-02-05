<?php

$routes->resource('users', ['controller'=>'UserController', 'except' => 'new,edit']);

