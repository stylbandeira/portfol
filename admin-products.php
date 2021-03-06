<?php
use Portfol\PageAdmin;
use Portfol\Model\User;
use Portfol\Model\Product;
use Portfol\Model\Category;

$app->get("/admin/products", function(){
    User::verifyLogin();
    $products = Product::listAll();
    $page = new PageAdmin();
    $page->setTpl("products", array(
        "products"=>$products
    ));
});

$app->get("/admin/products/create", function(){
    User::verifyLogin();
    $page = new PageAdmin();
    $category = Category::listAll();
    $page->setTpl("products-create", array(
        "categorias"=> $category
    ));
});

$app->post("/admin/products/create", function(){
    User::verifyLogin();
    $product = new Product();
    $product->setData($_POST);
    $product->save();
    header("Location: /admin/products");
    exit();
});

$app->get("/admin/products/:ID_ITEM", function($idproduct){
    User::verifyLogin();
    $product = new Product();
    $product->get((int)$idproduct);
    $category = Category::listAll();

    $page = new PageAdmin();
    $page->setTpl("products-update", array(
        'product'=>$product->getValues(),
        'categorias'=>$category
    ));
});

$app->post("/admin/products/:ID_ITEM", function($idproduct){
    User::verifyLogin();
    $product = new Product();
    $product->get((int)$idproduct);
    $product->setData($_POST);
        
    $product->save();
    $product->setPhoto($_FILES["file"]);
    header("Location: /admin/products");
    exit;
});

$app->get("/admin/products/:ID_ITEM/delete", function($idproduct){
    User::verifyLogin();
    $product = new Product();
    $product->get((int)$idproduct);
    $product->delete();
    header("Location: /admin/products");
    exit;
});

?>