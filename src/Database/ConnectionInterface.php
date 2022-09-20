<?php

namespace Volcano\Database;

interface ConnectionInterface
{
    /**
     * Returning results from the database
     *
     * @param string $query
     * @param array $bindings
     * @return QueryResult
     */
    public function select(string $query, array $bindings): QueryResult;

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
