<?php 
session_start();

require_once("vendor/autoload.php");
use \Slim\Slim;
use Portfol\Page;
use Portfol\PageAdmin;
use Portfol\Model\User;

$app = new Slim();

$app->config('debug', true);

$app->get('/', function() {
    $page = new Page();
    $page->setTpl("index");
});

$app->get('/admin', function() {
    User::verifyLogin();
    $page = new PageAdmin();
    $page->setTpl("index");
});

$app->get('/admin/login', function(){
    $page = new PageAdmin([
        "header"=>false,
        "footer"=>false
    ]);
    $page->setTpl("login");
});

$app->post('/admin/login', function(){
    User::login($_POST["login"], $_POST["password"]);
    header("Location: /admin");

    exit;
});

$app->get('/admin/logout', function(){
    User::logout();
    header("Location: /admin/login");
    exit;
});

$app->get("/admin/users", function(){
    User::verifyLogin();
    $users = User::listAll();
    $page = new PageAdmin();
    $page->setTpl("users", array(
        "users" => $users
    ));
    
});

$app->get("/admin/users/create", function(){
    User::verifyLogin();
    $page = new PageAdmin();
    $page->setTpl("users-create");
});

$app->get("/admin/users/:ID_USUARIO/delete", function($idUsuario){
    User::verifyLogin();
    $user = new User();
    $user->get((int)$idUsuario);
    $user->delete();

    header("Location: /admin/users");
    exit;
    
});

$app->get("/admin/users/:ID_USUARIO", function($idUsuario){
    User::verifyLogin();
    $user = new User();
    $user->get((int)$idUsuario);
    $page = new PageAdmin();
    $page->setTpl("users-update", array(
        "user"  =>  $user->getValues()
    ));
});

$app->post("/admin/users/create", function(){
    User::verifyLogin();
    $user = new User();
    $_POST["ISADMIN_USUARIO"] = (isset($_POST["ISADMIN_USUARIO"]))?1:0;
    $user->setData($_POST);
    $user->save();
    header("Location: /admin/users");
    exit;
});

$app->post("/admin/users/:ID_USUARIO", function($idUsuario){
    User::verifyLogin();
    $user = new User();
    $_POST["ISADMIN_USUARIO"] = (isset($_POST["ISADMIN_USUARIO"]))?1:0;
    $user->get((int)$idUsuario);
    $user->setData($_POST);
    $user->update();

    header("Location: /admin/users");
    exit;
});



$app->run();

 ?>