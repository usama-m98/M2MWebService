<?php

// Register component on container
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(
        $container['settings']['view']['template_path'],
        $container['settings']['view']['twig'],
        [
            'debug' => true // This line should enable debug mode
        ]
    );
    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

    return $view;
};

$container['validateMsg'] = function ($container) {
    $validator = new \Coursework\ValidateMessage();
    return $validator;
};

$container['soapWrapper'] = function ($container) {
    $soap_wrapper = new \Coursework\SoapWrapper();
    return $soap_wrapper;
};

$container['sqlQueries'] = function ($container){
    $queries = new \Coursework\SQLQueries();
    return $queries;
};

$container['databaseWrapper'] = function ($container){
    $database_wrapper = new \Coursework\DatabaseWrapper();
    return $database_wrapper;
};

$container['messageDataModel'] = function ($container){
    $model_wrapper = new \Coursework\MessageDataModel();
    return $model_wrapper;
};
