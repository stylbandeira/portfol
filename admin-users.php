<?php
use Portfol\PageAdmin;
use Portfol\Model\User;

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
?>