<?php
declare(strict_types=1);

namespace App\Exceptions;

use OutOfBoundsException;
use CodeIgniter\Exceptions\ExceptionInterface;
use CodeIgniter\Exceptions\HTTPExceptionInterface;

class NotFoundException extends OutOfBoundsException implements ExceptionInterface, HTTPExceptionInterface
{
    protected $code = 404;

    public static function forRecordNotFound(?string $message = null)
    {
        return new static($message ?? "Record not found");
    }
}