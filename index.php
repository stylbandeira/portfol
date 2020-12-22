<?php 

require_once("vendor/autoload.php");

$app = new \Slim\Slim();

$app->config('debug', true);

$app->get('/', function() {
    
    $sql = new Portfol\DB\Sql();
    $results = $sql->select("SELECT * FROM itens"); 
    echo json_encode($results);

});

$app->run();

 ?>