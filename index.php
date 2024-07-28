<?php
require 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// Créer un nouveau logger
$log = new Logger('app');
$log->pushHandler(new StreamHandler('app.log', Logger::DEBUG));

// Page d'accueil
function home() {
    global $log;
    $log->info('Home endpoint was reached');
    echo json_encode(["message" => "Hello, World!"]);
}

// Page d'erreur
function error() {
    global $log;
    try {
        throw new Exception('An error occurred');
    } catch (Exception $e) {
        $log->error($e->getMessage());
        echo json_encode(["error" => $e->getMessage()]);
    }
}

if ($_SERVER['REQUEST_URI'] == '/') {
    home();
} elseif ($_SERVER['REQUEST_URI'] == '/error') {
    error();
} else {
    http_response_code(404);
    echo json_encode(["error" => "Not Found"]);
}
