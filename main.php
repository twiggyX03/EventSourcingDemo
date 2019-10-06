<?php

// Required for autoloading.
require './spl_autoload.php';

// We need something that can function as a log.
$queue = new Queue();

// Add some events to the queue.
foreach(Factory::event(10) as $e)
{
    $queue->add($e);
}

// Construct the final state.
$state = State::construct($queue);

print($state);
