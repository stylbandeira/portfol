<?php
use Portfol\Page;
use Portfol\Model\Product;
use Portfol\Model\Table;
use Portfol\Model\Category;
use Portfol\Model\Order;
use Portfol\Model\Cliente;


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

$app->get("/order", function(){
    $page = new Page();
    $freeTables = Table::listEmpty();
    $page->setTpl("order", array(
        'freeTables' => $freeTables
    ));
});

$app->post("/order", function(){
    $order = new Order();
    $cliente = new Cliente();
    $cliente->setData($_POST);
    $cliente->save();

    $_POST['ID_CLIENTE'] = $cliente->getID_CLIENTE();
    $_POST['TIPO_PEDIDO'] = 'LOCAL';
    $order->setData($_POST);
    $order->save();
    header("Location: /order/".$order->getID_PEDIDO());
    exit;
});

$app->get("/order/:ID_PEDIDO", function($idPedido){
    $page = new Page();
    $order = new Order();
    $order->get((int)$idPedido);
    $page->setTpl("order-itens", array(
        'order' => $order->getValues()
    ));
});
?>