<?php

interface IEventDecoration
{
    // Decorating events enables complex predictions.
    public function __construct(IEvent $e);
}
