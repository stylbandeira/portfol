<?php 
session_start();

require_once("vendor/autoload.php");
use \Slim\Slim;
use Portfol\Page;
use Portfol\PageAdmin;
use Portfol\Model\User;
use Portfol\Model\Category;

$app = new Slim();

$app->config('debug', true);

$app->get('/', function() {
    $page = new Page();
    $page->setTpl("index");
});

$app->get('/album', function() {
    $page = new Page();
    $page->setTpl("album");
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

$app->get("/admin/forgot", function(){
    $page = new PageAdmin([
        "header"=>false,
        "footer"=>false
    ]);
    $page->setTpl("forgot");
});

$app->post("/admin/forgot", function(){
    $user = User::getForgot($_POST["email"]);
    header("Location: /admin/forgot/sent");
    exit;
});

$app->get("/admin/forgot/sent", function(){
    $page = new PageAdmin([
        "header"=>false,
        "footer"=>false
    ]);
    $page->setTpl("forgot-sent");
});

$app->get("/admin/forgot/reset", function(){
    $user = User::validForgotDecrypt($_GET["code"]);
    $page = new PageAdmin([
        "header"=>false,
        "footer"=>false
    ]);
    $page->setTpl("forgot-reset", array(
        "name" => $user["NOME_USUARIO"],
        "code" => $_GET["code"]
    ));
});

$app->post("/admin/forgot/reset", function(){
    $forgot = User::validForgotDecrypt($_POST["code"]);

    User::setForgotUsed($forgot["ID_RECOVERY"]);
    $user = new User();
    $user->get((int)$forgot["ID_USUARIO"]);
    $user->setPassword($_POST["password"]);

    $page = new PageAdmin([
        "header"=>false,
        "footer"=>false
    ]);
    $page->setTpl("forgot-reset-success");
});

$app->get("/admin/categories", function(){
    User::verifyLogin();
    $categories = Category::listAll();
    $page = new PageAdmin();
    $page->setTpl("categories", array(
        "categories" => $categories
    ));
});

$app->get("/admin/categories/create", function(){
    User::verifyLogin();
    $page = new PageAdmin();
    $page->setTpl("categories-create");
});

$app->post("/admin/categories/create", function(){
    User::verifyLogin();
    $category = new Category();
    $category->setData($_POST);
    $category->save();
    header("Location: /admin/categories");
    exit;
});

$app->get("/admin/categories/:ID_CATEGORIA/delete", function($idcategory){
    User::verifyLogin();
    $category = new Category();
    $category->get((int)$idcategory);
    $category->delete();
    header("Location: /admin/categories");
    exit;
});

$app->get("/admin/categories/:ID_CATEGORIA", function($idcategory){
    User::verifyLogin();
    $category = new Category();
    $category->get((int)$idcategory);

    $page = new PageAdmin();
    $page->setTpl("categories-update", array(
        "category" => $category->getValues()
    ));
});

$app->post("/admin/categories/:ID_CATEGORIA", function($idcategory){
    User::verifyLogin();
    $category = new Category();
    $category->get((int)$idcategory);
    $category->setData($_POST);
    $category->save();

    header("Location: /admin/categories");
    exit;
});

$app->get("/categories/:ID_CATEGORIA", function($ID_CATEGORIA){
    $category = new Category();
    $category->get((int)$ID_CATEGORIA);
    $page = new Page();
    $page->setTpl("category", array(
        'category'=>$category->getValues(),
        'products'=>[]
    ));
});

$app->run();

 ?>