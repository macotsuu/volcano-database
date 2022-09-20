<?php

namespace Apollo\Database;

interface IteratorInterface
{
    /**
     * Returns the number of elements
     *
     * @return int
     */
    public function count(): int;

    /**
     * Return the current element
     *
     * @return mixed
     */
    public function current(): mixed;

    /**
     * Return the key of the current element
     *
     * @return int
     */
    public function key(): int;

    /**
     * Move forward to next element
     *
     * @return void
     */
    public function next(): void;

    /**
     * Rewind the Iterator to the first element
     *
     * @return void
     */
    public function rewind(): void;

    /**
     * Checks if current position is valid
     *
     * @return bool
     */
    public function valid(): bool;

    /**
     * Return an item from a specified position
     *
     * @param int $index
     * @return mixed
     */
    public function at(int $index): mixed;
}
