<?php

namespace App\Exceptions;

use App\Enums\ApiCRUDlExceptionsEnum;
use Exception;
use Throwable;

class CRUDException extends Exception
{
    public function __construct(
        public ApiCRUDlExceptionsEnum $case,
        public string                 $field,
        Throwable                     $previous = null
    ) {
        parent::__construct($case->label($field), $case->code(), $previous);
    }
}
