<?php
namespace Portfol\Model;

use Portfol\DB\Sql;
use Portfol\Model;
use Portfol\Model\User;
use Portfol\Model\Cliente;


class Order extends Model{
    const SESSION = "Order";

    public static function getFromSession(){
        $order = new Order();
        
        if (
        isset($_SESSION[Order::SESSION]) && 
        ((int)$_SESSION[Order::SESSION]['ID_PEDIDO']) > 0
        )
        {
            $order->get((int)$_SESSION[Order::SESSION]['ID_PEDIDO']);
        }
        else if (
            isset($_SESSION[User::SESSION]) &&
            ((int)$_SESSION[User::SESSION]['ID_USUARIO'] > 0)
        ) {
            $idUsuario = (int)$_SESSION[User::SESSION]['ID_USUARIO'];
            $cliente = Cliente::getUserCliente($idUsuario);
            $order->getOpenClientOrder($cliente->getID_CLIENTE());
        } 
        else{
            
            $order->getFromSessionID();
            if (!(int)$order->getID_PEDIDO() > 0) {
                // $cliente = new Cliente();
                // $dadosCliente = array(
                //     'NOME_CLIENTE' => 'ClienteTemporario_'.session_id()
                // ); 
                // $cliente->setData($dadosCliente);
                // $cliente->save();

                // $data = array(
                //     'ID_SESSAO' => session_id(),
                //     'ID_CLIENTE' => $cliente->getNOME_CLIENTE(),
                //     'TIPO_PEDIDO' => 'LOCAL'
                // );
                // if (User::checkLogin(false)) {
                //     $user = User::getFromSession();
                //     $data['ID_USUARIO'] = $user->getID_USUARIO();
                // }
                // $order->save();
                // $order->setToSession();
            }
        }
    }

    public function setToSession(){
        $_SESSION[Order::SESSION] = $this->getValues();
    }

    public function getFromSessionID(){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM pedido WHERE ID_SESSAO = :ID_SESSAO 
                                AND STATUS_PEDIDO = 'ABERTO'", array(
            ':ID_SESSAO' => session_id()
        ));
        if (count($results) > 0) {
            $this->setData($results[0]);
        }
    }

    public static function listAll(){
        $sql = new SQL();
        return $sql->select("SELECT p.ID_PEDIDO, p.ID_CLIENTE, p.TIPO_PEDIDO, p.VAL_TOTAL, p.STATUS_PEDIDO, p.ID_MESA, c.NOME_CLIENTE FROM pedido p
        INNER JOIN cliente c
        ON c.ID_CLIENTE = p.ID_CLIENTE
        INNER JOIN mesa m
        GROUP BY p.ID_PEDIDO;");
    }

    public static function listOpen(){
        $sql = new SQL();
        return $sql->select("SELECT p.ID_PEDIDO, p.ID_CLIENTE, p.TIPO_PEDIDO, p.VAL_TOTAL, p.STATUS_PEDIDO, p.ID_MESA, c.NOME_CLIENTE FROM pedido p
        INNER JOIN cliente c
        ON c.ID_CLIENTE = p.ID_CLIENTE
        INNER JOIN mesa m
        WHERE p.STATUS_PEDIDO = 'ABERTO'
        GROUP BY p.ID_PEDIDO;");
    }

    public function orderItens($idorder){
        $sql = new SQL();
        return $sql->select("SELECT ip.VAL_PARCIAL, it.NOME_ITEM, it.PRECO_ITEM, ip.QTD FROM itens_pedido ip
                            INNER JOIN pedido pe
                            ON ip.ID_PEDIDO = pe.ID_PEDIDO
                            INNER JOIN itens it 
                            ON ip.ID_ITEM = it.ID_ITEM
                            WHERE ip.ID_PEDIDO = :ID_PEDIDO", array(
                                ":ID_PEDIDO" => $idorder
                            ));
    }

    public function save(){
        $sql = new Sql();
        $results = $sql->select("CALL st_pedido_save (
                        :ID_MESA,
                        :ID_PEDIDO, 
                        :ID_CLIENTE,
                        :TIPO_PEDIDO,
                        :STATUS_PEDIDO,
                        :ID_SESSAO
                        )", array(
                            ":ID_MESA" => $this->getID_MESA(),
                            ":ID_PEDIDO"    =>  $this->getID_PEDIDO(),
                            ":ID_CLIENTE"     =>  $this->getID_CLIENTE(),
                            ":TIPO_PEDIDO" => $this->getTIPO_PEDIDO(),
                            ":STATUS_PEDIDO" => "ABERTO",
                            ":ID_SESSAO" =>session_id()
                        ));
        $this->setData($results[0]);
    }

    public function get($idPedido){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM pedido WHERE ID_PEDIDO = :ID_PEDIDO", array(
            ":ID_PEDIDO" => $idPedido 
        ));        
        if (count($results) > 0) {
            $this->setData($results[0]);
        }
    }

    public function getOpenClientOrder($idCliente){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM pedido 
            WHERE ID_CLIENTE = :ID_CLIENTE AND
            STATUS_PEDIDO = 'ABERTO'", array(
            ':ID_CLIENTE' => (int)$idCliente['ID_CLIENTE']
        ));
        $this->setData($results[0]);
    }

    public function getOpenUserOrder($idUsuario){
        $sql = new Sql();
        $results = $sql->select("SELECT ID_CLIENTE FROM cliente 
            WHERE ID_USUARIO = :ID_USUARIO", array(
                ':ID_USUARIO' => $idUsuario
            ));
        $this->getOpenClientOrder($results[0]);
        
    }

    public function addItem($item, $qtd){
        $sql = new Sql();
        $results = $sql->select("CALL st_addItem(
                        :ID_ITEM,
                        :QTD,
                        :ID_PEDIDO
                    )", array(
                        ":ID_ITEM" =>$item->getID_ITEM(),
                        ":QTD" => $qtd,
                        ":ID_PEDIDO" => $this->getID_PEDIDO()
                    ));
        $this->setData($results[0]);
    }

    public function getOrderData($idPedido){
        $sql = new Sql();
        $active = $sql->select("SELECT * FROM mesa WHERE ID_PEDIDO = :ID_PEDIDO", array(
            ":ID_PEDIDO"=>$idPedido
        ));
        
        if (sizeof($active) > 0) {
            $results = $sql->select("SELECT * FROM pedido p
                                INNER JOIN log_pedidos l
                                ON p.ID_PEDIDO = l.ID_PEDIDO
                                INNER JOIN cliente c
                                ON c.ID_CLIENTE = p.ID_CLIENTE
                                INNER JOIN mesa m 
                                ON m.ID_PEDIDO = p.ID_PEDIDO
                                WHERE p.ID_PEDIDO = :ID_PEDIDO;", array(
                                    ":ID_PEDIDO" => $idPedido
                                ));                                
            
        }
        else {
            $results = $sql->select("SELECT * FROM pedido p
                                INNER JOIN cliente c
                                ON c.ID_CLIENTE = p.ID_CLIENTE
                                WHERE p.ID_PEDIDO = :ID_PEDIDO;", array(
                                    ":ID_PEDIDO" => $idPedido
                                ));                                
            
        }
        return $results[0];    
    }

    public function payOrder($idPedido){
        $sql = new Sql();
        $results = $sql->select("UPDATE pedido 
                                SET STATUS_PEDIDO = 'PAGO'
                                WHERE ID_PEDIDO = :ID_PEDIDO", array(
                                    ":ID_PEDIDO"=>$idPedido
                                ));
    }

    public function delete(){
        if ($this->getVAL_TOTAL() > 0) {
            throw new \Exception("Você não pode apagar uma conta que ainda não foi paga!", 1);
        } else {
        $sql = new Sql();
        $sql->query("CALL st_apaga_pedido(:ID_PEDIDO)", array(
            ":ID_PEDIDO" => $this->getID_PEDIDO()
        ));     
    }
    }
}
?>