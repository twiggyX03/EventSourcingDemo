<?php

class State
{
    public $state = 5;

    public static function construct(Queue $q)
    {
        $state = new static;
        while($e = $q->remove()) {
            $state = $e->resolve($state);
        }

        return $state;
    }

    // Helper for nicer printing.
    public function __toString()
    {
        return (string) $this->state;
    }
}
