<?php
require_once 'src/config/Database.php';
require_once 'src/controllers/PlayerController.php';

$database = new Database();
$db = $database->getConnection();
$playerController = new PlayerController($db);
$requestMethod = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($uri) {
    case '/create':
        if ($requestMethod === 'POST') {
            $playerController->createPlayer();
        } else {
            include 'src/views/create.php';
        }
        break;

    case '/read':
        $playerController->readPlayers();
        break;

    case '/update':
        if ($requestMethod === 'POST') {
            $playerController->updatePlayer();
        } else {
            include 'src/views/update.php';
        }
        break;

    case '/delete':
        if ($requestMethod === 'POST') {
            $playerController->deletePlayer();
        } else {
            include 'src/views/delete.php';
        }
        break;

    default:
        http_response_code(404);
        echo "404 Not Found";
        break;
}
?>