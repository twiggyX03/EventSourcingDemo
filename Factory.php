<?php

class Factory
{
    public static function event(int $n)
    {
        $acc = [];
        $terminator = new class implements IEvent {
            public function resolve(State $s) : State {
                return $s;
            }
        };

        $acc[] = $terminator;

        foreach(range(0, $n) as $_) {
            // Create somewhat random results.
            if(rand(0, 1000) / 1000 > .25) {
                $acc[] = new Record($terminator);
            } else {
                $acc[] = new Prediction($terminator);
            }
        }

        return $acc;
    }
}
