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
        return $sql->select("SELECT it.NOME_ITEM, it.PRECO_ITEM, ip.QTD FROM itens_pedido ip
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
                            ":STATUS_PEDIDO" => $this->getSTATUS_PEDIDO()
                        ));
        $this->setData($results[0]);
    }

    public function get($idpedido){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM pedido WHERE ID_MESA = :ID_MESA", array(
            ":ID_MESA" => $idtable 
        ));        
        $this->setData($results[0]);
    }

    public function delete(){
        $sql = new Sql();
        $sql->query("DELETE FROM mesa WHERE ID_MESA = :ID_MESA", array(
            ":ID_MESA" => $this->getID_MESA()
        ));
    }
}
?>