<?php
namespace Portfol\Model;

use Portfol\DB\Sql;
use Portfol\Model;
use Portfol\Mailer;


class Category extends Model{

    public static function listAll(){
        $sql = new SQL();
        return $sql->select("SELECT * FROM categorias ORDER BY DESC_CATEGORIA");
    }

    public function save(){
        $sql = new Sql();
        $results = $sql->select("CALL st_categories_save (
                        :ID_CATEGORIA, 
                        :DESC_CATEGORIA 
                        )", array(
                            ":ID_CATEGORIA"    =>  $this->getID_CATEGORIA(),
                            ":DESC_CATEGORIA"     =>  $this->getDESC_CATEGORIA()
                        ));
        $this->setData($results[0]);
    }

    public function get($idcategory){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM categorias WHERE ID_CATEGORIA = :ID_CATEGORIA", array(
            ":ID_CATEGORIA" => $idcategory 
        ));        
        $this->setData($results[0]);
    }

    public function delete(){
        $sql = new Sql();
        $sql->query("DELETE FROM categorias WHERE ID_CATEGORIA = :ID_CATEGORIA", array(
            ":ID_CATEGORIA" => $this->getID_CATEGORIA()
        ));
    }
}
?>