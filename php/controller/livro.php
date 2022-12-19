<?php
/**
 * Requires 
 * model/user.php and
 * config/database.php
 * to works perfectly
 */
class LivroController  
{
    
    public function saveLivro($livro, $conn) {
        $sql = "INSERT INTO ".LivroEntries::TBNAME."(".LivroEntries::NOME.", ".LivroEntries::GENERO.", ".LivroEntries::EDITORA.", ".LivroEntries::STATUS.", ".LivroEntries::COMENTARIO.", ".LivroEntries::USUARIO_ID.") VALUES (:livro_nome, :genero, :editora, :status_livro, :comentario, :usuario_id)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":livro_nome", $livro->getLivroNome());
        $stmt->bindValue(":genero", $livro->getGenero());
        $stmt->bindValue(":editora", $livro->getEditora());
        $stmt->bindValue(":status_livro", $livro->getStatus());
        $stmt->bindValue(":comentario", $livro->getComentario());
        $stmt->bindValue(":usuario_id", $livro->getUsuarioId());
        
        return $stmt->execute(); 
    }

    public function updateLivro($livro, $conn, $usuario_id, $livro_nome) {
        $sql = "UPDATE ".LivroEntries::TBNAME." set ".LivroEntries::NOME." = :livro_nome, ".LivroEntries::GENERO." = :genero, ".LivroEntries::EDITORA." = :editora, ".LivroEntries::STATUS." = :status_livro, ".LivroEntries::COMENTARIO." = :comentario WHERE ".LivroEntries::USUARIO_ID." = '$usuario_id' AND ".LivroEntries::NOME." = '".$livro_nome."'";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":livro_nome", $livro->getLivroNome());
        $stmt->bindValue(":genero", $livro->getGenero());
        $stmt->bindValue(":editora", $livro->getEditora());
        $stmt->bindValue(":status_livro", $livro->getStatus());
        $stmt->bindValue(":comentario", $livro->getComentario());
        
        return $stmt->execute(); 
    }
        
    public function getLivros($usuarioId, $conn) {
        $sql = "SELECT * FROM ".LivroEntries::TBNAME." WHERE ".LivroEntries::USUARIO_ID."='".$usuarioId."'";
        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "livro", array(LivroEntries::NOME,LivroEntries::GENERO,LivroEntries::EDITORA,LivroEntries::STATUS,LivroEntries::COMENTARIO,LivroEntries::USUARIO_ID));
        $stmt->execute();
        
        return $stmt->fetchAll();
    }

    public function getLivrosByName($nameLivro, $conn) {
        $sql = "SELECT * FROM ".LivroEntries::TBNAME." WHERE ".LivroEntries::NOME."='".$nameLivro."'";
        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "livro", array(LivroEntries::NOME,LivroEntries::GENERO,LivroEntries::EDITORA,LivroEntries::STATUS,LivroEntries::COMENTARIO,LivroEntries::USUARIO_ID));
        $stmt->execute();
        
        return $stmt->fetchAll();
    }

    public function getLivrosByNameAndId($nameLivro, $usuarioId, $conn) {
        $sql = "SELECT * FROM ".LivroEntries::TBNAME." WHERE ".LivroEntries::NOME."='".$nameLivro."' AND ".LivroEntries::USUARIO_ID."='".$usuarioId."'";
        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "livro", array(LivroEntries::NOME,LivroEntries::GENERO,LivroEntries::EDITORA,LivroEntries::STATUS,LivroEntries::COMENTARIO,LivroEntries::USUARIO_ID));
        $stmt->execute();
        
        return $stmt->fetchAll();
    }

    public function getLastLivros($usuarioId, $conn) {
        $sql = "SELECT * FROM ".LivroEntries::TBNAME." WHERE ".LivroEntries::USUARIO_ID."='".$usuarioId."' ORDER BY ".LivroEntries::ID." DESC LIMIT 5";

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "livro", array(LivroEntries::NOME,LivroEntries::GENERO,LivroEntries::EDITORA,LivroEntries::STATUS,LivroEntries::COMENTARIO,LivroEntries::USUARIO_ID));
        $stmt->execute();
        
        return $stmt->fetchAll();
    }

    public function getQuantLido($usuarioId, $conn) {
        $sql = "SELECT * FROM ".LivroEntries::TBNAME." WHERE ".LivroEntries::STATUS." = 'lido' AND ".LivroEntries::USUARIO_ID." = '".$usuarioId."'";
        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "livro", array(LivroEntries::NOME,LivroEntries::GENERO,LivroEntries::EDITORA,LivroEntries::STATUS,LivroEntries::COMENTARIO,LivroEntries::USUARIO_ID));
        $stmt->execute();
        
        return $stmt->rowCount();
    }

    public function getQuantParaLer($usuarioId, $conn) {
        $sql = "SELECT * FROM ".LivroEntries::TBNAME." WHERE ".LivroEntries::STATUS." = 'ler' AND ".LivroEntries::USUARIO_ID." = '".$usuarioId."'";
        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "livro", array(LivroEntries::NOME,LivroEntries::GENERO,LivroEntries::EDITORA,LivroEntries::STATUS,LivroEntries::COMENTARIO,LivroEntries::USUARIO_ID));
        $stmt->execute();
        
        return $stmt->rowCount();
    }

    public function getQuantLendo($usuarioId, $conn) {
        $sql = "SELECT * FROM ".LivroEntries::TBNAME." WHERE ".LivroEntries::STATUS." = 'lendo' AND ".LivroEntries::USUARIO_ID." = '".$usuarioId."'";
        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "livro", array(LivroEntries::NOME,LivroEntries::GENERO,LivroEntries::EDITORA,LivroEntries::STATUS,LivroEntries::COMENTARIO,LivroEntries::USUARIO_ID));
        $stmt->execute();
        
        return $stmt->rowCount();
    }

    public function getQuantComentados($usuarioId, $conn) {
        $sql = "SELECT * FROM ".LivroEntries::TBNAME." WHERE ".LivroEntries::USUARIO_ID." = '".$usuarioId."'";
        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "livro", array(LivroEntries::NOME,LivroEntries::GENERO,LivroEntries::EDITORA,LivroEntries::STATUS,LivroEntries::COMENTARIO,LivroEntries::USUARIO_ID));
        $stmt->execute();
        
        return $stmt->rowCount();
    }

    public function getComentariosUsuarios($usuarioId, $conn) {
        $sql = "SELECT * FROM ".LivroEntries::TBNAME." WHERE ".LivroEntries::USUARIO_ID." = '".$usuarioId."'";
        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "livro", array(LivroEntries::NOME,LivroEntries::GENERO,LivroEntries::EDITORA,LivroEntries::STATUS,LivroEntries::COMENTARIO,LivroEntries::USUARIO_ID));
        $stmt->execute();
        
        return $stmt->rowCount();
    }

    public function deleteLivro($livro, $conn) {
        $sql = "DELETE FROM ".LivroEntries::TBNAME." WHERE ".LivroEntries::NOME." = :livro_nome AND ".LivroEntries::USUARIO_ID." = :usuario_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":livro_nome", $livro->getLivroNome());
        $stmt->bindValue(":usuario_id", $livro->getUsuarioId());
        return $stmt->execute();
    }
    
}


/* são as variaveis que temos no BD, temos que declarar igual está lá */
class LivroEntries 
{
    const TBNAME = "livro";
    const ID = "id";
    const NOME = "livro_nome";
    const GENERO = "genero";
    const EDITORA = "editora";
    const STATUS = "status_livro";
    const COMENTARIO = "comentario";
    const USUARIO_ID = "usuario_id";
}

?>