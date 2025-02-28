<?php

namespace App\Infrastructure\Event;

use App\Domain\Event\EventDispatcherInterface;

class SimpleEventDispatcher implements EventDispatcherInterface
{
    private array $listeners = [];

    public function dispatch(string $eventName, object $event): void
    {
        if (isset($this->listeners[$eventName])) {
            foreach ($this->listeners[$eventName] as $listener) {
                $listener($event);
            }
        }
    }

    public function addListener(string $eventName, callable $listener): void
    {
        $this->listeners[$eventName][] = $listener;
    }
}