<?php

namespace App\Infrastructure\Event;

use App\Domain\User\UserRegisteredEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserRegisteredEventHandler implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            UserRegisteredEvent::class => 'onUserRegistered',
        ];
    }

    public function onUserRegistered(UserRegisteredEvent $event): void
    {
        echo sprintf("Sending welcome email to %s\n", $event->email()->value());
    }
}