<?php
use Portfol\Page;
use Portfol\Model\Product;
use Portfol\Model\Table;
use Portfol\Model\Category;
use Portfol\Model\Order;
use Portfol\Model\Cliente;
use Portfol\Model\User;

require_once("functions.php");


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
    $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
    $category = new Category();
    $category->get((int)$ID_CATEGORIA);
    //$products = Product::categoryProducts($ID_CATEGORIA);
    $pagination = $category->getProductsPage($page);
    
    $pages = array();
    for ($i=1; $i <= $pagination['pages'] ; $i++) { 
        array_push($pages, array(
            'link' => '/categories/'.$category->getID_CATEGORIA().'?page='.$i,
            'page' =>$i
        ));
    }
    $page = new Page();
    $page->setTpl("category", array(
        'category'=>$category->getValues(),
        'products'=>$pagination["data"],
        'pages' => $pages
    ));
});

$app->get("/order", function(){
    $page = new Page();
    if (isset($_SESSION['Order']) && ($_SESSION['Order']['STATUS_PEDIDO'] === 'ABERTO')) {
        // $order->getFromSession();
        header("Location: /order/".$_SESSION['Order']['ID_PEDIDO']);
        exit;
    } 
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
    $itens = Product::listAll();
    $page = new Page();
    $order = new Order();
    $order->get((int)$idPedido);
    $order->setToSession();
    $page->setTpl("order-itens", array(
        'order' => $order->getValues(),
        'orderItens' => $order->orderItens($idPedido),
        'itens' => Product::checkList($itens)
    ));
});

$app->get("/order/:ID_PEDIDO/pay", function($idPedido){
    $order = new Order();
    

    //IR PARA FORMA DE PAGAMENTO
    $order->payOrder((int)$idPedido);
    //IR PARA FORMA DE PAGAMENTO
    header("Location: /");
    exit;
});

$app->post("/order/:ID_PEDIDO/:ID_ITEM/add", function($idPedido, $idItem){
    $item = new Product();
    $item->get((int)$idItem);
    $order = new Order();
    $order->get((int)$idPedido);
    $qtd = $_POST['QTD'];

    $order->addItem($item, $qtd);
    header("Location: /order/".$idPedido);
    exit;
});

$app->get("/register", function(){
    $page = new Page([
        "header" => false,
        "footer" => false
    ]);
    // if (isset($_POST["login"])) {
    //     $typeError = 'login';
    // } else {
    //     $typeError = 'register';
    // }
    $page->setTpl("user-register", array(
        'error'=>User::getError(),
        'typeError'=> 'EE'
    ));
});

$app->post("/register", function(){
    $user = new User();
    $_POST["ISADMIN_USUARIO"] = (isset($_POST["ISADMIN_USUARIO"]))?1:0;
    try{$user->setData($_POST);
        $user->save();
        header("Location: /");
    }catch(Exception $e){
        User::setError($e->getMessage());
        header("Location: /register");
    }
    exit;
});

//LOGIN CLIENTE

$app->post("/login", function(){
    try{
        User::login($_POST['LOGIN_USUARIO'], $_POST['PASS_USUARIO']);
        header("Location: /");
    }catch(Exception $e){
        User::setError($e->getMessage());
        header("Location: /register");
    }
    exit;
});
?>