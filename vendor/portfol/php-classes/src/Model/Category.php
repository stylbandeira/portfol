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
        Category::updateFile();
    }

    public function get($idcategory){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM categorias WHERE ID_CATEGORIA = :ID_CATEGORIA", array(
            ":ID_CATEGORIA" => $idcategory 
        ));        
        $this->setData($results[0]);
    }

    public function getProductsPage($page = 1, $itensPerPage = 8){
        $sql = new Sql();
        $start = ($page - 1) * $itensPerPage;
        $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM itens i
                    INNER JOIN categorias c ON c.ID_CATEGORIA = i.ID_CATEGORIA
                    WHERE c.ID_CATEGORIA = :ID_CATEGORIA
                    LIMIT $start, $itensPerPage;", array(
                        ":ID_CATEGORIA" => $this->getID_CATEGORIA()
                    ));

        $resultTotal = $sql->select("SELECT FOUND_ROWS() AS NRITENS;");

        return array(
            'data' =>Product::checkList($results),
            'total' => (int)$resultTotal[0]['NRITENS'],
            'pages' => ceil($resultTotal[0]['NRITENS'] / $itensPerPage)
        );
        
    }

    public function delete(){
        $sql = new Sql();
        $sql->query("DELETE FROM categorias WHERE ID_CATEGORIA = :ID_CATEGORIA", array(
            ":ID_CATEGORIA" => $this->getID_CATEGORIA()
        ));
        Category::updateFile();
    }

    public static function updateFile(){
        $categories = Category::listAll();
        $html = [];
        foreach ($categories as $row) {
            array_push($html, '<li><a href="/categories/'.$row['ID_CATEGORIA'].'">'.$row['DESC_CATEGORIA'].'</a></li>');
        }
        file_put_contents($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR."views".DIRECTORY_SEPARATOR."categories-menu.html", implode('', $html));

    }
}
?>