<?php
use Portfol\PageAdmin;
use Portfol\Model\User;
use Portfol\Model\Table;

$app->get("/admin/tables", function(){
    User::verifyLogin();
    $tables = Table::listAll();
    $page = new PageAdmin();
    $page->setTpl("tables", array(
        "tables"=>$tables
    ));
});

$app->get("/admin/tables/create", function(){
    User::verifyLogin();
    $page = new PageAdmin();
    $page->setTpl("tables-create");
});

$app->post("/admin/tables/create", function(){
    User::verifyLogin();
    $table = new Table();
    $table->setData($_POST);
    $table->save();
    header("Location: /admin/tables");
    exit;
});

$app->get("/admin/tables/:ID_MESA/delete", function($idmesa){
    User::verifyLogin();
    $table = new Table();
    $table->get((int)$idmesa);
    $table->delete();
    header("Location: /admin/tables");
    exit;
});

?>