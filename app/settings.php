<?php

ini_set('display_errors', 'On');
ini_set('html_errors', 'On');
ini_set('xdebug.trace_output_name', 'coursework.%t');
ini_set('xdebug.trace_format', '1');

$app_url = dirname($_SERVER['SCRIPT_NAME']);
$css_file_path = $app_url . '/css/client.css';
define('CSS_PATH', $css_file_path);
define('APPLICATION_NAME', 'EEM2M SMS Client');

$url_root = $_SERVER['SCRIPT_NAME'];
$url_root = implode('/', explode('/', $url_root, -1));
define('LANDING_PAGE', $url_root);

$wsdl = 'https://m2mconnect.ee.co.uk/orange-soap/services/MessageServiceByCountry?wsdl';
define('WSDL', $wsdl);



$settings = [
    "settings" => [
        'displayErrorDetails' => true,
        'addContentLengthHeader' => false,
        'mode' => 'development',
        'debug' => true,
        'class_path' => __DIR__ . '/src/',
        'view' => [
            'template_path' => __DIR__ . '/templates/',
            'twig' => [
                'cache' => false,
                'auto_reload' => true
            ]],
        'm2m_connection' => [
            'username' => "19p17222327",
            'password' => "Bdrhctxr_456",
            'msisdn' => "+447817814149",
            'delivery_report' => true,
            'mt_bearer' => "SMS",
        ],
        'pdo_settings' => [
            'rdbms' => 'mysql',
            'host' => 'localhost',
            'db_name' => 'coursework_db',
            'port' => '3306',
            'user_name' => 'coursework_user',
            'user_password' => 'letmein',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'options' => [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => true,
            ],
        ]
    ],
];

return $settings;