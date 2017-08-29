<?php
declare(strict_types=1);

require_once 'vendor/autoload.php';

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use FeGFFB\Predigten\Controller\PredigtController;
use WoohooLabs\Harmony\Harmony;
use WoohooLabs\Harmony\Middleware\DiactorosResponderMiddleware;
use WoohooLabs\Harmony\Middleware\DispatcherMiddleware;
use WoohooLabs\Harmony\Middleware\FastRouteMiddleware;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\SapiEmitter;
use Zend\Diactoros\ServerRequestFactory;
// Initializing the request and the response objects
$request = ServerRequestFactory::fromGlobals();
$response = new Response();

// Initializing the router
$router = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute("GET", "/predigten/", [PredigtController::class, "getPredigten"]);
    $r->addRoute("GET", "/predigten/{slug}", [PredigtController::class, "getPredigt"]);
    
});

// Stacking up middleware
$harmony = new Harmony(ServerRequestFactory::fromGlobals(), new Response());
$harmony
    ->addMiddleware(new DiactorosResponderMiddleware(new SapiEmitter()))
    ->addMiddleware(new FastRouteMiddleware($router))
    ->addMiddleware(new DispatcherMiddleware());
// Run!
$harmony();
header('Content-Type: application/json');
?>