<?php

require_once '../private/App/functions.php';
require_once '../vendor/autoload.php';

use Jerome\Blog\App\ConfigParser;
use Jerome\Blog\App\Paths;
use Bramus\Router\Router;

header_remove('X-Powered-By');
session_start(['name' => 'session']);

ConfigParser::load(Paths::CONFIG);
date_default_timezone_set($_ENV['TIME_ZONE']);

$router = new Router();

$router->get('/', '\Jerome\Blog\Controllers\HomeController::index');
$router->get('/posts/{slug}', '\Jerome\Blog\Controllers\SingleController::index');
$router->post('/posts/{slug}', '\Jerome\Blog\Controllers\SingleController::POST_comment');

$router->get('/posts', '\Jerome\Blog\Controllers\ArchiveController::index');
$router->get('/tutorials', '\Jerome\Blog\Controllers\ArchiveController::tutorials');

$router->get('/login', '\Jerome\Blog\Controllers\AuthController::login_page');
$router->post('/login', '\Jerome\Blog\Controllers\AuthController::POST_login');
$router->get('/logout', '\Jerome\Blog\Controllers\AuthController::logout');

$router->before('GET|POST', '/admin(\/.*|)', '\Jerome\Blog\Controllers\AuthController::guard');

$router->match('GET|POST', '/admin', '\Jerome\Blog\Controllers\AdminController::index');
$router->post('/admin/upload', '\Jerome\Blog\Controllers\ImageUploadController::POST_image');
$router->get('/admin/{slug}', '\Jerome\Blog\Controllers\AdminController::edit_post');
$router->post('/admin/{slug}', '\Jerome\Blog\Controllers\AdminController::POST_save_post');

$router->set404('\Jerome\Blog\App\RespondWith::error_page');

try {
    ob_start();
    $router->run();
    echo ob_get_clean();
} catch(Exception) {
    ob_end_clean();
    view('error', code: 500);
}