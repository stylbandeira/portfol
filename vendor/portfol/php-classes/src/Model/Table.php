<?php
namespace Portfol\Model;

use Portfol\DB\Sql;
use Portfol\Model;


class Table extends Model{

    public static function listAll(){
        $sql = new SQL();
        return $sql->select("SELECT * FROM mesa");
    }

    public function save(){
        $sql = new Sql();
        $results = $sql->select("CALL st_tables_save (
                        :ID_MESA, 
                        :ID_PEDIDO
                        )", array(
                            ":ID_MESA"    =>  $this->getID_MESA(),
                            ":ID_PEDIDO"     =>  NULL
                        ));
        $this->setData($results[0]);
    }

    public function get($idtable){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM mesa WHERE ID_MESA = :ID_MESA", array(
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