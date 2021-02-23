<?php
namespace Portfol\Model;

use Portfol\DB\Sql;
use Portfol\Model;
use Portfol\Mailer;
use Portfol\Model\Cliente;


class User extends Model{
    const SESSION = "User";
    const SECRET = "HcodePhp7_Secret";
    const SECRET_IV = "HcodePhp7_Secret_IV";
    
    public static function getFromSession(){
        $user = new User();
        if (isset($_SESSION[User::SESSION]) && ((int)$_SESSION[User::SESSION]['ID_USUARIO']) > 0) {
            $user->setData($_SESSION[User::SESSION]);
        }
        
        return $user;
    }

    public static function checkLogin($inAdmin = true){
        if(!isset($_SESSION[User::SESSION])
            || 
            !$_SESSION[User::SESSION]
            ||
            !(int)$_SESSION[User::SESSION]["ID_USUARIO"] > 0){
                //não está logado
                return false;
                
            } else{
                if ($inAdmin === true && ((bool)$_SESSION[User::SESSION]['ISADMIN_USUARIO'] === true)) {
                    return true;
                } else if ($inAdmin === false){
                    return true;
                } else {
                    return false;
                }
            }
    }

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
        if (!User::checkLogin($inAdmin)) {
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

    public static function getForgot($email){
        $sql = new Sql();
        $results = $sql->select("SELECT * 
        FROM usuario
        WHERE EMAIL_USUARIO = :email;", array(
            ":email"=>$email
        ));

        if (count($results) === 0){
            throw new \Exception("Não foi possível recuperar a senha");
        } else{
            $data = $results[0];
            $remote = $data["REMOTE_ADDR"] ?? '127.0.0.1';
            $results2 = $sql->select("CALL st_userspasswordrecoveries_create(:ID_USUARIO, :IP_USUARIO)", array(
                ":ID_USUARIO"=> (int)$data["ID_USUARIO"],
                ":IP_USUARIO"=> $remote
            ));

            if (count($results2) === 0) {
                throw new \Exception("Não foi possível recuperar a senha");
            }else {
                $dataRecovery = $results2[0];
                $code = openssl_encrypt($dataRecovery['ID_RECOVERY'], 'AES-128-CBC', pack("a16", User::SECRET), 0, pack("a16", User::SECRET_IV));                
                $code = base64_encode($code);
                $link = "http://www.portfol.com.br/admin/forgot/reset?code=$code";
                $mailer = new Mailer($data["EMAIL_USUARIO"], $data["NOME_USUARIO"], "Redefinição de Senha do Portfol", "forgot", array(
                    "name"=>$data["NOME_USUARIO"],
                    "link"=>$link
                ));

                $mailer->send();
                return $data;
            }
        }
    }

    public static function validForgotDecrypt($code){
        $code = base64_decode($code);
        $idrecovery = openssl_decrypt($code, 'AES-128-CBC', pack("a16", User::SECRET), 0, pack("a16", User::SECRET_IV));
        $sql = new Sql();
        $results = $sql->select("
        SELECT * FROM log_userpasswordrecoveries a
        INNER JOIN usuario b USING(ID_USUARIO)
        WHERE a.ID_RECOVERY = :ID_RECOVERY
        AND 
        a.DTRECOVERY IS NULL
        AND
        DATE_ADD(DTREGISTER, INTERVAL 1 HOUR) >= NOW();
        ", array(
            ":ID_RECOVERY" => $idrecovery
        ));

        if (count($results) === 0) {
            throw new \Exception("Não foi possível recuperar a senha");
            
        } else {
            return $results[0];
        }
    }

    public static function setForgotUsed($idrecovery){
        $sql = new Sql();

        $sql->query("UPDATE log_userpasswordrecoveries SET DTRECOVERY = NOW() WHERE ID_RECOVERY = :ID_RECOVERY", array(
            ":ID_RECOVERY" => $idrecovery
        ));
    }

    public function setPassword($password){
        $sql = new Sql();
        $sql->query("UPDATE usuario SET PASS_USUARIO = :PASS_USUARIO WHERE ID_USUARIO = :ID_USUARIO", array(
            ":PASS_USUARIO" => $password,
            ":ID_USUARIO" => $this->getID_USUARIO()
        ));    
    }
}
?>