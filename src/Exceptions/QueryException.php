<?php

namespace Volcano\Database\Exceptions;

use PDOException;
use Throwable;

class QueryException extends PDOException
{
    protected string $sql;
    protected array $bindings;

    public function __construct(string $sql, array $bindings, Throwable $previous)
    {
        parent::__construct('', 0, $previous);

        $this->code = $previous->getCode();
        $this->sql = $sql;
        $this->bindings = $bindings;
        $this->message = "\nQuery: " . $this->sql . "\nParams: " . print_r($this->bindings, true);
    }
}
