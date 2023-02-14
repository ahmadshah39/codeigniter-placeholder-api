<?php

if(!function_exists('print_all')){
   function print_all($data){
      var_dump($data);
      exit;
   }
}

if(!function_exists('http_exception_code')){
   function http_exception_code(int $code){
      $exception_codes = [
        400,
        401,
        402,
        403,
        404,
        406,
        429,
        500,
        502,
        503,
        403,
      ];
      return in_array($code, $exception_codes) ? $code : 200;
   }
}

