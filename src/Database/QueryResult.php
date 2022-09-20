<?php

namespace Volcano\Database;

class QueryResult implements IteratorInterface
{
    private array $result;
    private int $position;

    public function __construct(array $result)
    {
        $this->result = $result;
        $this->position = 0;
    }

    public function count(): int
    {
        return count($this->result);
    }

    public function current(): mixed
    {
        return $this->result[$this->position];
    }

    public function key(): int
    {
        return $this->position;
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function valid(): bool
    {
        return array_key_exists($this->position, $this->result);
    }

    public function at(int $index): mixed
    {
        if (!isset($this->result[$index])) {
            return null;
        }

        return $this->result[$index];
    }
}
