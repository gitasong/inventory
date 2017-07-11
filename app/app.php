<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Book.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost:8889;dbname=inventory';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('books' => Book::getAll()));
    });

    $app->post("/", function() use ($app) {
        $new_book = new Book($_POST['title'], $_POST['author']);
        $new_book->save();
        return $app['twig']->render('index.html.twig', array('books' => Book::getAll()));
    });


    return $app;
?>
