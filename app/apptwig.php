<?php

/**
 * Silex application with minimum functionality and twig support.
 *
 * Only requires:
 *   "silex/silex" : "1.0.*"
 *   "twig/twig": "1.*"
 *   "twig/extensions": "*"
 *
 * Physical path added:
 *   app/cache
 *   views
 */

require_once __DIR__.'/../vendor/autoload.php';

// paramètres
$debug = true;

// application instance
$app          = new Silex\Application();
$app['debug'] = $debug;

// add twig support
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path'    => __DIR__.'/../views',
    'twig.options' => array(
        'debug' => true,
        'cache' => __DIR__.'/cache'
    )
));
if ($debug) {
    $app['twig']->addExtension(new Twig_Extensions_Extension_Debug());
}

// accueil
$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html.twig', array(
    ));
});
