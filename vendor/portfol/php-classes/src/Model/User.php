<?php
namespace Portfol\Model;
use Portfol\DB\Sql;
use Portfol\Model;


class User extends Model{
    const SESSION = "User";

    public static function login($login, $password){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM usuario WHERE LOGIN_USUARIO = :LOGIN", array(
            ":LOGIN" => $login
        ));

        if (count($results) === 0) {
            throw new \Exception("Usuário inexistente ou senha inválida", 1);
        }
        $data = $results[0];
        
        if ($password == $data["PASS_USUARIO"]) {
            $user = new User();
            $user->setData($data);
            $_SESSION[User::SESSION] = $user->getValues();
            return $user;


        } else {
            throw new \Exception("Usuário inexistente ou senha inválida", 1);
        }
    }
    
    public static function verifyLogin($inAdmin = true){
        if (!isset($_SESSION[User::SESSION])
            || 
            !$_SESSION[User::SESSION]
            ||
            !(int)$_SESSION[User::SESSION]["ID_USUARIO"] > 0
            ||
            (bool)$_SESSION[User::SESSION]["ISADMIN_USUARIO"] != $inAdmin) {
            header("Location: /admin/login");
            exit;
        }
    }

    public static function logout(){
        $_SESSION[User::SESSION] = NULL;
    }

    public static function listAll(){
        $sql = new SQL();
        return $sql->select("SELECT * FROM usuario");
    }

    public function save(){
        $sql = new Sql();
        $results = $sql->select("CALL st_usuario_save (
                        :LOGIN_USUARIO, 
                        :PASS_USUARIO, 
                        :ISADMIN_USUARIO, 
                        :EMAIL_USUARIO, 
                        :TELEFONE_USUARIO, 
                        :NOME_USUARIO)", array(
                            ":LOGIN_USUARIO"    =>  $this->getLOGIN_USUARIO(),
                            ":PASS_USUARIO"     =>  $this->getPASS_USUARIO(),
                            ":ISADMIN_USUARIO"  =>  $this->getISADMIN_USUARIO(),
                            ":EMAIL_USUARIO"    =>  $this->getEMAIL_USUARIO(),
                            ":TELEFONE_USUARIO" =>  $this->getTELEFONE_USUARIO(),
                            ":NOME_USUARIO"     =>  $this->getNOME_USUARIO()
                        ));
        $this->setData($results[0]);
    }

    public function get($idUsuario){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM usuario WHERE ID_USUARIO = :idUsuario", array(
            ":idUsuario"    =>  $idUsuario
        ));

        $this->setData($results[0]);
    }

    public function update(){
        $sql = new Sql();
        $results = $sql->select("CALL st_usuarioupdate_save (
                        :ID_USUARIO,
                        :LOGIN_USUARIO, 
                        :PASS_USUARIO, 
                        :ISADMIN_USUARIO, 
                        :EMAIL_USUARIO, 
                        :TELEFONE_USUARIO, 
                        :NOME_USUARIO)", array(
                            ":ID_USUARIO"       => $this->getID_USUARIO(),
                            ":LOGIN_USUARIO"    =>  $this->getLOGIN_USUARIO(),
                            ":PASS_USUARIO"     =>  $this->getPASS_USUARIO(),
                            ":ISADMIN_USUARIO"  =>  $this->getISADMIN_USUARIO(),
                            ":EMAIL_USUARIO"    =>  $this->getEMAIL_USUARIO(),
                            ":TELEFONE_USUARIO" =>  $this->getTELEFONE_USUARIO(),
                            ":NOME_USUARIO"     =>  $this->getNOME_USUARIO()
                        ));
        $this->setData($results[0]);
    }

    public function delete(){
        $sql = new Sql();
        
        $sql->query("CALL st_users_delete(:ID_USUARIO)", array(
            ":ID_USUARIO"=>$this->getID_USUARIO()
        ));
    }
}
?>