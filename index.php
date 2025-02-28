<?php

require_once __DIR__ . '/bootstrap.php'; 

use App\Infrastructure\Controller\RegisterUserController;
use App\Application\UseCase\RegisterUserUseCase;
use App\Domain\User\Repository\DoctrineUserRepository;
use App\Infrastructure\Event\SimpleEventDispatcher;
use App\Domain\User\Event\UserRegisteredEvent;

global $entityManager;

$userRepository = new DoctrineUserRepository($entityManager);

$eventDispatcher = new SimpleEventDispatcher();

$eventDispatcher->addListener(UserRegisteredEvent::class, function (UserRegisteredEvent $event) {
    echo "Enviando correo de bienvenida a: " . $event->email()->value() . "\n";
});

$registerUserUseCase = new RegisterUserUseCase($userRepository, $eventDispatcher);

$registerUserController = new RegisterUserController($registerUserUseCase);

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestUri === '/register' && $requestMethod === 'POST') {
    $requestBody = file_get_contents('php://input');
    $requestData = json_decode($requestBody, true);

    $response = $registerUserController->handleRequest($requestData);

    header('Content-Type: application/json');
    echo json_encode($response);
    return;
}

header('Content-Type: application/json');
http_response_code(404);
echo json_encode(['error' => 'Resource not found']);