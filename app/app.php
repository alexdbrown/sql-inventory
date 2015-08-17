<?php
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/Inventory.php';

    $app = new Silex\Application();

    $app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=inventory';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig');
    });

    $app->post("/items", function() use ($app) {
        $item = new Inventory($_POST['item']);
        $item->save();
        return $app['twig']->render('index.html.twig', array('items' => Inventory::getAll()));
    });

    $app->post("/delete_items", function() use ($app) {
        Inventory::deleteAll();
        return $app['twig']->render('index.html.twig');
    });

    $app->post("/search_items", function() use ($app) {
        $results = Inventory::find($_POST['search_item']);
        return $app['twig']->render('search_results.html.twig', array('results' => $results));
    });

    return $app;
?>
