<?php
use Portfol\PageAdmin;
use Portfol\Model\User;
use Portfol\Model\Order;
use Portfol\Model\Table;

$app->get("/admin/orders", function(){
    User::verifyLogin();
    $orders = Order::listAll();
    
    $page = new PageAdmin();
    $page->setTpl("orders", array(
        "orders"=>$orders
    ));
});

$app->get("/admin/orders/create", function(){
    User::verifyLogin();  
    $page = new PageAdmin();
    $page->setTpl("orders-create");
});


$app->post("/admin/orders/create", function(){
        User::verifyLogin();
        $order = new Order();
        $order->setData($_POST);
        
        $order->save();
        header("Location: /admin/orders");
        exit;
    });
// $app->get("/admin/tables", function(){
//     User::verifyLogin();
//     $tables = Table::listAll();
//     $page = new PageAdmin();
//     $page->setTpl("tables", array(
//         "tables"=>$tables
//     ));
// });

// $app->get("/admin/tables/create", function(){
//     User::verifyLogin();
//     $page = new PageAdmin();
//     $page->setTpl("tables-create");
// });

// $app->post("/admin/tables/create", function(){
//     User::verifyLogin();
//     $table = new Table();
//     $table->setData($_POST);
//     $table->save();
//     header("Location: /admin/tables");
//     exit;
// });

// $app->get("/admin/tables/:ID_MESA/delete", function($idmesa){
//     User::verifyLogin();
//     $table = new Table();
//     $table->get((int)$idmesa);
//     $table->delete();
//     header("Location: /admin/tables");
//     exit;
// });

?>