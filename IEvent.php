<?php

interface IEvent
{
    // Resolve the event against the current state,
    // producing a new state.
    public function resolve(State $s) : State;
}
