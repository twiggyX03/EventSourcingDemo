<?php

// Event that might happen.
class Prediction implements IEvent, IEventDecoration 
{
    protected $event;

    public function __construct(IEvent $e)
    {
        $this->event = $e;
    }

    // When a prediction resolves, its truth value can be used to make decisions.
    public function resolve(State $s) : State
    {
        $newS = $this->event->resolve($s);

        if($newS->state > 5) {
            return $s;
        }

        return $newS;
    }
}
