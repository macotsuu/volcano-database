<?php

    namespace Apollo;

    interface ConnectionInterface
    {
        public function select(string $query, array $bindings): QueryResult;
        public function insert(string $query, array $bindings): int;
    }
