<?php

/**
 * Silex application with doctrine support.
 *
 * Requires:
 *   "silex/silex" : "1.0.*"
 *   "doctrine/dbal": ">=2.1, <2.3",
 *
 * Physical path added:
 *   data
 */

require_once __DIR__.'/../vendor/autoload.php';

// paramètres
$debug = true;

// application instance
$app          = new Silex\Application();
$app['debug'] = $debug;

// doctrine support
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver'   => 'pdo_sqlite',
        'path'     => __DIR__.'/../data/app.db',
     )
));
// $app->register(new Knp\Provider\RepositoryServiceProvider(), array(
//     'repository.repositories' => array(
//         'pages' => 'Devpro\Component\SiteContent\Entity\PageRepository',
//     )
// ));

// accueil
$app->get('/', function () use ($app) {
//     var_dump(get_class($app['db'])); // Doctrine\DBAL\Connection
    $sql = "SELECT * FROM page";
    $pages = $app['db']->fetchAll($sql);

    return  "<h1>Page {$pages[0]['id']}</h1>".
    "<p>{$pages[0]['title']}</p>";
});

// $app->get('/repo', function () use ($app) {
//     $pages = $app['pages']
//         //->findAll();
//         ->findOneBy(array('title' => 'Test'));

//     var_dump($pages);

//     return "";
// });
