<?php
use Portfol\PageAdmin;
use Portfol\Model\User;
use Portfol\Model\Order;
use Portfol\Model\Table;
use Portfol\Model\Cliente;

$app->get("/admin/orders", function(){
    User::verifyLogin();
    $orders = Order::listOpen();
    
    $page = new PageAdmin();
    $page->setTpl("orders", array(
        "orders"=>$orders
    ));
});

$app->get("/admin/orders/create", function(){
    User::verifyLogin();  
    $freeTables = Table::listEmpty();
    $page = new PageAdmin();
    $page->setTpl("orders-create", array(
        "freeTables"=>$freeTables
    ));
});


$app->post("/admin/orders/create", function(){
        User::verifyLogin();
        $cliente = new Cliente();
        
        $order = new Order();

        $cliente->setData($_POST);
        $cliente->save();
        $idCliente = $cliente->getID_CLIENTE();
        $_POST["ID_CLIENTE"] = $idCliente;
        $order->setData($_POST);
        $order->save();
        header("Location: /admin/orders");
        exit;
    });

    $app->get("/admin/orders/:ID_PEDIDO/delete", function($idPedido){
        User::verifyLogin();
        $order = new Order();
        $order->get((int)$idPedido);
        $order->delete();
        header("Location: /admin/orders");
        exit;
    });

    $app->get("/admin/orders/:ID_PEDIDO", function($idPedido){
        User::verifyLogin();
        $order = new Order();
        $order->get((int)$idPedido);
       
        $page = new PageAdmin();
        $page->setTpl("orders-update", array(
        "order"  =>  $order->getOrderData($idPedido),
        "orderItens" => $order->orderItens($idPedido)
    ));
    });

    $app->get("/admin/orders/:ID_PEDIDO/pay", function($idPedido){
        User::verifyLogin();
        $order = new Order();
        $order->payOrder((int)$idPedido);
        header("Location: /admin/orders");
        exit;
    });

// $app->get("/admin/tables/:ID_MESA/delete", function($idmesa){
//     User::verifyLogin();
//     $table = new Table();
//     $table->get((int)$idmesa);
//     $table->delete();
//     header("Location: /admin/tables");
//     exit;
// });

?>