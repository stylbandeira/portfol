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
                        :NOME_CLIENTE,
                        :ID_USUARIO
                        )", array(
                            ":ID_CLIENTE"    =>  $this->getID_CLIENTE(),
                            ":NOME_CLIENTE"     =>  $this->getNOME_CLIENTE(),
                            ":ID_USUARIO" => $this->getID_USUARIO()
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

    public function set($user){
        $sql = new Sql();
        $results = $sql->select("CALL st_cliente_save (
            :ID_CLIENTE, 
            :NOME_CLIENTE,
            :ID_USUARIO
            )", array(
                ":ID_CLIENTE"    =>  0,
                ":NOME_CLIENTE"     =>  $user->getNOME_USUARIO(),
                ":ID_USUARIO" => $user->getID_USUARIO()
            ));
        $this->setData($results[0]);
    }

    public static function getUserCliente($idUser){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM cliente WHERE ID_USUARIO = :ID_USUARIO", array(
            ":ID_USUARIO" => $idUser
        ));
        $cliente = new Cliente();
        if (count($results) > 0) {
            $cliente->get((int)$results[0]['ID_CLIENTE']);
        } else {
            $user = new User();
            $user->get((int)$idUser);
            $cliente->set($user);
        }
        return $cliente;
    }

    public function delete(){
        $sql = new Sql();
        $sql->query("DELETE FROM cliente WHERE ID_CLIENTE = :ID_CLIENTE", array(
            ":ID_CLIENTE" => $this->getID_CLIENTE()
        ));
    }
}
?>