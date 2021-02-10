<?php
namespace Portfol\Model;

use Portfol\DB\Sql;
use Portfol\Model;


class Order extends Model{

    public static function listAll(){
        $sql = new SQL();
        return $sql->select("SELECT * FROM pedido p
                            INNER JOIN log_pedidos l
                            ON p.ID_PEDIDO = l.ID_PEDIDO
                            INNER JOIN cliente c
                            ON c.ID_CLIENTE = p.ID_CLIENTE
                            INNER JOIN mesa m 
                            ON m.ID_PEDIDO = p.ID_PEDIDO;");
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
                        :STATUS_PEDIDO
                        )", array(
                            ":ID_MESA" => $this->getID_MESA(),
                            ":ID_PEDIDO"    =>  $this->getID_PEDIDO(),
                            ":ID_CLIENTE"     =>  $this->getID_CLIENTE(),
                            ":TIPO_PEDIDO" => $this->getTIPO_PEDIDO(),
                            ":STATUS_PEDIDO" => "ABERTO"
                        ));
        $this->setData($results[0]);
    }

    public function get($idPedido){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM pedido WHERE ID_PEDIDO = :ID_PEDIDO", array(
            ":ID_PEDIDO" => $idPedido 
        ));        
        $this->setData($results[0]);
    }

    public function addItem($idItem, $qtd){
        $sql = new Sql();
        $results = $sql->select("CALL st_addItem(
                        :ID_ITEM,
                        :QTD,
                        :ID_PEDIDO
                    )", array(
                        ":ID_ITEM" =>$idItem,
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
                                SET STATUS_PEDIDO = 'PAGO',
                                ID_MESA = NULL
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