<?php
/**
 * Requires 
 * model/user.php and
 * config/database.php
 * to works perfectly
 */
class UsuarioController  
{
    
    public function saveUsuario($usuario, $conn) {
        $sql = "INSERT INTO ".UsuarioEntries::TBNAME."(".UsuarioEntries::USUARIO.", ".UsuarioEntries::EMAIL.", ".UsuarioEntries::SENHA.") VALUES (:usuario, :email, :senha)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":usuario", $usuario->getUsuario());
        $stmt->bindValue(":email", $usuario->getEmail());
        $stmt->bindValue(":senha", $usuario->getSenha());
        
        return $stmt->execute(); 
    }
        
    public function getUsuario($usuario, $conn) {
        $sql = "SELECT * FROM ".UsuarioEntries::TBNAME." WHERE ".UsuarioEntries::EMAIL." = :email AND ".UsuarioEntries::SENHA." = :senha";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":email", $usuario->getEmail());
        $stmt->bindValue(":senha", $usuario->getSenha());
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "usuario", array(UsuarioEntries::USUARIO,UsuarioEntries::EMAIL,UsuarioEntries::SENHA));
        $stmt->execute();
        
        return $stmt->fetch();
    }

    public function getIdUsuario($email, $conn) {
        $sql = "SELECT id FROM ".UsuarioEntries::TBNAME." WHERE ".UsuarioEntries::EMAIL." = '".$email."'";
        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "usuario", array(UsuarioEntries::USUARIO,UsuarioEntries::EMAIL,UsuarioEntries::SENHA));
        $stmt->execute();
        
        return $stmt->fetch();
    }

    public function getNameUsuario($id, $conn) {
        $sql = "SELECT usuario FROM ".UsuarioEntries::TBNAME." WHERE id = '".$id."'";
        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "usuario", array(UsuarioEntries::USUARIO,UsuarioEntries::EMAIL,UsuarioEntries::SENHA));
        $stmt->execute();
        
        return $stmt->fetch();
    }
    
}


/* são as variaveis que temos no BD, temos que declarar igual está lá */
class UsuarioEntries 
{
    const TBNAME = "usuario";
    const USUARIO = "usuario";
    const EMAIL = "email";
    const SENHA = "senha";
}

?>