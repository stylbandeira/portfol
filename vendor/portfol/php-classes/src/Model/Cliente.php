<?php
namespace Portfol\Model;

use Portfol\DB\Sql;
use Portfol\Model;


class Cliente extends Model{

    public static function listAll(){
        $sql = new SQL();
        return $sql->select("SELECT * FROM cliente");
    }

    public function save(){
        $sql = new Sql();
        $results = $sql->select("CALL st_cliente_save (
                        :ID_CLIENTE, 
                        :NOME_CLIENTE
                        )", array(
                            ":ID_CLIENTE"    =>  $this->getID_CLIENTE(),
                            ":NOME_CLIENTE"     =>  $this->getNOME_CLIENTE()
                        ));
        $this->setData($results[0]);
    }

    public function get($idcliente){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM cliente WHERE ID_CLIENTE = :ID_CLIENTE", array(
            ":ID_CLIENTE" => $idcliente 
        ));        
        $this->setData($results[0]);
    }

    public function delete(){
        $sql = new Sql();
        $sql->query("DELETE FROM cliente WHERE ID_CLIENTE = :ID_CLIENTE", array(
            ":ID_CLIENTE" => $this->getID_CLIENTE()
        ));
    }
}
?>