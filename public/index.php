<?php

/*
    index.php : controler frontal (front controller)
        fichier appelé à chaque requête HTTP
*/

//auto-chargement des classes avec composer
require_once '../vendor/autoload.php';

use App\Controller\ProductController;
use App\Core\Container;
use App\Core\Dotenv;
use App\Core\Routing;
use App\Core\Database;
use App\Query\ProductQuerry;
use App\Query\UserQuery;
use App\Service\JWT;

// chargement du fichier .env
Dotenv::load();

//$db = new Database();
//var_dump($db->connect());exit;
//$userQuery = Container::getInstance(UserQuery::class);
//echo'<pre>'; var_dump($userQuery->checkUser('admin', 'admin')); echo'<pre>'; exit;
// import des classes
//use App\Core\Routing;
//$product = Container::getInstance(ProductController::class); 
$jwt = Container::getInstance(JWT::class);
//echo'<pre>'; var_dump($jwt->generate()); echo'<pre>';
//echo'<pre>'; var_dump($jwt->verify('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpYXQiOjE2MTM2NTU4Mzd9.Nzc4ZGZiMzc2YTY0NzM2NTkzMjVkOTQ2NGMwMjE0NzdjNTFmOWQ4M2JjMjJmNTM3MDhmMTFiNjcyZGM0ODNkOA')); echo'<pre>'; exit;
//routage
//$routing = new Routing(); 
// Prpriété statique créée sur tous les objets qui permet de récupérer l'espace de nom sou forme de chaine de caracteres
$routing = Container::getInstance(Routing::class);
$routInfos = $routing->getRouteInfo();
//echo'<pre>'; var_dump($routing); echo'<pre>'; exit;
//echo'<pre>'; var_dump($routInfos); echo'<pre>'; exit;

//espade de nom du controller :App\Controller\...
$controllerName = "App\Controller\\{$routInfos['controller']}";
//echo'<pre>'; var_dump($controllerName); echo'<pre>';

// intansation du controller
$controller = Container::getInstance($controllerName);
//$controller = Container::getInstance();

// appel de la methode
// ... spread operator permet de convertir des tableux associatifs en arguments
// ['id" => 50] > id=50
$controller->{$routInfos['method']}(...$routInfos['vars']);
