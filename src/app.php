<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app['debug'] = true;

$app->get('/', function () {
    return 'Hello World!';
});

$app->get('/demo', function () {
    return 'Démo';
});

/*
$app->get('/{name}', function ($name) use ($app) {
    $app->abort(404);
});
*/

$app->error(function (\Exception $e, $code) {
    if (404 == $code) {
        return 'The requested page could not be found.';
    }
});
