<?php

namespace Volcano\Database;

use Iterator;

interface ConnectionInterface
{
    /**
     * Returning results from the database
     *
     * @param string $query
     * @param array $bindings
     * @return Iterator
     */
    public function select(string $query, array $bindings): Iterator;

    /**
     * Inserting a record into the database
     *
     * @param string $query
     * @param array $bindings
     * @return int
     */
    public function insert(string $query, array $bindings): int;

    /**
     * Updating records in the database
     *
     * @param string $query
     * @param array $bindings
     * @return int
     */
    public function update(string $query, array $bindings = []): int;

    /**
     * Executing an SQL query
     *
     * @param string $query
     * @param array $bindings
     * @return int
     */
    public function delete(string $query, array $bindings = []): int;
}
