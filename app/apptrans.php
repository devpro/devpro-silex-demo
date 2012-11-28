<?php

/**
 * Silex application with twig and translation support.
 *
 * Requires:
 *   "silex/silex" : "1.0.*"
 *   "twig/twig": "1.*"
 *   "twig/extensions": "*"
 *   "symfony/config": "2.1.*"
 *   "symfony/translation": "2.1.*"
 *   "symfony/twig-bridge": "2.1.*"
 *
 * Physical path added:
 *   app/cache
 *   app/locales
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

// ajout fonctionnalité translate
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'locale'          => 'fr',
    'locale_fallback' => 'fr'
));
$app['translator'] = $app->share($app->extend('translator', function($translator, $app) {
    $translator->addLoader('yaml', new Symfony\Component\Translation\Loader\YamlFileLoader());
    $translator->addResource('yaml', __DIR__.'/locales/fr.yml', 'fr');
    $translator->addResource('yaml', __DIR__.'/locales/en.yml', 'en');
    return $translator;
}));
$app['twig']->addExtension(
    new Symfony\Bridge\Twig\Extension\TranslationExtension($app['translator'])
);

// accueil
$app->get('/', function () use ($app) {
    return $app['twig']->render('demo-translation.html.twig', array(
    ));
});
