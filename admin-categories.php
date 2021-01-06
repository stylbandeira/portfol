<?php
use Portfol\PageAdmin;
use Portfol\Page;
use Portfol\Model\User;
use Portfol\Model\Category;

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
?>