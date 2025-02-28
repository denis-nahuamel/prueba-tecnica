<?php

namespace App\Domain\Event;

interface EventDispatcherInterface
{
    public function dispatch(string $eventName, object $event): void;
}