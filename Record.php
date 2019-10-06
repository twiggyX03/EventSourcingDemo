<?php

// Event that actually happened.
class Record implements IEvent, IEventDecoration
{
    protected $event;

    public function __construct(IEvent $e)
    {
        $this->event = $e;
    }

    public function resolve(State $s) : State
    {
        $newS = $this->event->resolve($s);
        $newS->state += 1;

        return $newS;
    }
}
