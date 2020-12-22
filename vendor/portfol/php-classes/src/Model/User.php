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
}
?>