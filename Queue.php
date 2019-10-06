<?php

class Queue
{
    protected $data;

    public function __construct()
    {
        $this->data = [];
    }

    public function add($e)
    {
        $this->data[] = $e;
    }

    public function remove()
    {
        return array_shift($this->data); 
    } 
}
