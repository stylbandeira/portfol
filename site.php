<?php
use Portfol\Page;
use Portfol\Model\Product;


$app->get('/', function() {
    $itens = Product::listAll();
    $page = new Page();
    $page->setTpl("index", array(
        'itens' => Product::checkList($itens)
    ));
    var_dump($itens);
});

$app->get('/album', function() {
    $page = new Page();
    $page->setTpl("album");
});

?>