<?php

/**
 * Silex application with minimum functionality.
 *
 * Only requires:
 *   "silex/silex" : "1.0.*"
 */

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();
// $app['debug'] = true; // if needed for debug

$app->get('/', function () {
    return 'Hello World!';
});

$app->get('/demo', function () {
    return '<p>Démo</p>';
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
