<?php
use Portfol\Page;
use Portfol\Model\Product;
use Portfol\Model\Category;


$app->get('/', function() {
    $itens = Product::listAll();
    $page = new Page();
    $page->setTpl("index", array(
        'itens' => Product::checkList($itens)
    ));
});

$app->get('/album', function() {
    $page = new Page();
    $page->setTpl("album");
});

$app->get("/categories/:ID_CATEGORIA", function($ID_CATEGORIA){
    $category = new Category();
    $products = Product::categoryProducts($ID_CATEGORIA);
    $category->get((int)$ID_CATEGORIA);
    $page = new Page();
    $page->setTpl("category", array(
        'category'=>$category->getValues(),
        'products'=>$products
    ));
});
?>