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

print("random run: " . $state . "\n");

class ComplexPrediction implements IEvent {
    public $event;
    public $callable;
    public function __construct(IEvent $e, Callable $f) {
        $this->event = $e;
        $this->callable = $f;
    }

    public function resolve(State $s) : State {
        $newS = $this->event->resolve($s);
        if(($this->callable)($newS)) {
            $newS->state *= 2;
            return $newS;
        }

        return $s;
    }
};

// Some more complex behaviour
$terminator = new class implements IEvent {
    public function resolve(State $s) : State {
        return $s;
    }
};

// Make a decision after inspecting the current state
$prediction1Func = function ($s) {
    return $s->state == 6;
};

// Make a decision after inspecting the current state
$prediction2Func = function ($s) {
    if ($s->state > 10 || $s->lastUpdated == 1) {
        return true;
    }
    return false;
};

$record = new Record($terminator); // S->state = 6
$prediction1 = new ComplexPrediction($record, $prediction1Func); // S->state = 12
$prediction2 = new ComplexPrediction($prediction1, $prediction2Func); // S->state = 24

$q2 = new Queue();
$q2->add($prediction2);
$q2->add($record); // S->state = 25
print("Complex prediction: " . State::construct($q2) . "\n");
