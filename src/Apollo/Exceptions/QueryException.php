<?php

    namespace Apollo\Exceptions;

    use Throwable;
    use PDOException;

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
            $this->message = print_r($this->sql + $this->bindings, true);
        }
    }
