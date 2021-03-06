<?php
namespace Portfol\Model;

use Portfol\DB\Sql;
use Portfol\Model;
use Portfol\Mailer;


class Product extends Model{

    public static function listAll(){
        $sql = new SQL();
        return $sql->select("SELECT * FROM itens ORDER BY ID_ITEM");
    }

    public static function checkList($list){
        foreach ($list as $row) {
            $p = new Product();
            $p->setData($row);
            $row = $p->getValues();
        }
        return $list;
    }
    public static function categoryProducts($idCategory){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM itens  WHERE ID_CATEGORIA = :ID_CATEGORIA", array(
            ':ID_CATEGORIA'=>$idCategory
        ));

        return $results;
    }

    public function save(){
        $sql = new Sql();
        $results = $sql->select("CALL st_products_save (
                        :ID_ITEM, 
                        :NOME_ITEM,
                        :PRECO_ITEM,
                        :SRC_IMG,
                        :ID_CATEGORIA 
                        )", array(
                            ":ID_ITEM"    =>  $this->getID_ITEM(),
                            ":NOME_ITEM"     =>  $this->getNOME_ITEM(),
                            ":PRECO_ITEM" => $this->getPRECO_ITEM(),
                            ":SRC_IMG" => $this->getSRC_IMG(),
                            ":ID_CATEGORIA" => $this->getID_CATEGORIA()
                        ));
        $this->setData($results[0]);
    }

    public function get($idproduct){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM itens WHERE ID_ITEM = :ID_ITEM", array(
            ":ID_ITEM" => $idproduct 
        ));        
        $this->setData($results[0]);
    }

    public function delete(){
        $sql = new Sql();
        $sql->query("DELETE FROM itens WHERE ID_ITEM = :ID_ITEM", array(
            ":ID_ITEM" => $this->getID_ITEM()
        ));
    }

    public function checkPhoto(){
        if (file_exists($_SERVER['DOCUMENT_ROOT']. '/' . 
        "res". '/' . 
        "site". '/' .
        "img". '/' .
        "products". '/' .
        $this->getID_ITEM().".jpg")) {
            $url = "/res/site/img/products/".$this->getID_ITEM().".jpg";
        } else {
            $url = "/res/site/img/products/product.jpg";
        }

        return $this->setSRC_IMG($url);
    }

    public function getValues(){
        $this->checkPhoto();
        $values = parent::getValues();
        return $values;
    }

    public function setPhoto($file){
        $image;
        $extension = explode(".", $file['name']);
        $extension = end($extension);

        switch ($extension) {
            case 'jpg':
                $image = imagecreatefromjpeg($file["tmp_name"]);
                break;
            case 'jpeg':
                $image = imagecreatefromjpeg($file["tmp_name"]);
                break;
            case 'gif':
                $image = imagecreatefromgif($file["tmp_name"]);
                break;
            case 'png':
                $image = imagecreatefrompng($file["tmp_name"]);
                break;
            default:
            
            echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Ocorreu um erro ao enviar este formato de imagem. A alteração não foi salva.')
                    window.location.href='/admin/products';
                    </SCRIPT>");
            exit;
        }
        $dist = $_SERVER['DOCUMENT_ROOT']. DIRECTORY_SEPARATOR . 
        "res". DIRECTORY_SEPARATOR . 
        "site". DIRECTORY_SEPARATOR .
        "img". DIRECTORY_SEPARATOR .
        "products". DIRECTORY_SEPARATOR .
        $this->getID_ITEM().".jpg";

        if ($image) {
            imagejpeg($image, $dist);
            imagedestroy($image);
            $this->checkPhoto();
        } else {
            header("Location: /admin/products");
        }
        
        
    }

}
?>