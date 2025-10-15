<?php
namespace App\Shared\Exceptions;

use Exception;
use Illuminate\Http\Response;

class DomainException extends Exception
{
    public function __construct(protected $message = "", protected int $status = Response::HTTP_BAD_REQUEST)
    {
        parent::__construct($message);
    }


    public static function forInvalidEmail(): self
    {
        return new self("آدرس ایمیل نامعتبر است.", Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public static function forNotFound(string $entity): self
    {
        return new self("$entity یافت نشد.", Response::HTTP_NOT_FOUND);
    }
}
