<?php

require_once("Conexao.php");

class Usuario {
    private $idUsuario;
    private $nomeUsuario;
    private $cpfUsuario;
    private $dataNasc;
    private $sexoUsuario;
    private $celUsuario;
    private $emailUsuario;
    private $senhaUsuario;
   

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function getNomeUsuario() {
        return $this->nomeUsuario;
    }
 
    public function getCpfUsuario() {
        return $this->cpfUsuario;
    }

    public function getDataNasc() {
        return $this->dataNasc;
    }

    public function getSexoUsuario() {
        return $this->sexoUsuario;
    }

    public function getCelUsuario() {
        return $this->celUsuario;
    }

    public function getEmailUsuario() {
        return $this->emailUsuario;
    }

    public function getSenhaUsuario() {
        return $this->senhaUsuario;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function setNomeUsuario($nomeUsuario) {
        $this->nomeUsuario = $nomeUsuario;
    }

    public function setCpfUsuario($cpfUsuario) {
        $this->cpfUsuario = $cpfUsuario;
    }

    public function setDataNasc($dataNasc) {
        $this->dataNasc = $dataNasc;
    }

    public function setSexoUsuario($sexoUsuario) {
        $this->sexoUsuario = $sexoUsuario;
    }

    public function setCelUsuario($celUsuario) {
        $this->celUsuario = $celUsuario;
    }

    public function setEmailUsuario($emailUsuario) {
        $this->emailUsuario = $emailUsuario;
    }

    public function setSenhaUsuario($senhaUsuario) {
        $this->senhaUsuario = $senhaUsuario;
    }



    public function cadastrar($usuario) {
        $conexao = Conexao::conectar();

        $stmt = $conexao->prepare("INSERT INTO tbUsuario (nomeUsuario, cpfUsuario, dataNasc, sexoUsuario, celUsuario, emailUsuario, senhaUsuario)
                                   VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bindValue(1, $usuario->getNomeUsuario());
        $stmt->bindValue(2, $usuario->getCpfUsuario());
        $stmt->bindValue(3, $usuario->getDataNasc());
        $stmt->bindValue(4, $usuario->getSexoUsuario());
        $stmt->bindValue(5, $usuario->getCelUsuario());
        $stmt->bindValue(6, $usuario->getEmailUsuario());
        $stmt->bindValue(7, $usuario->getSenhaUsuario());
    

        $stmt->execute();
    }

    public function validarLogin($email, $senha) {
        $conexao = Conexao::conectar();
    
        $stmt = $conexao->prepare("SELECT senhaUsuario FROM tbUsuario WHERE emailUsuario = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        if (count($result) > 0) {
            $senhaCriptografada = $result[0]['senhaUsuario'];
            if (password_verify($senha, $senhaCriptografada)) {
                $stmt = $conexao->prepare("SELECT idUsuario FROM tbUsuario WHERE emailUsuario = :email");
                $stmt->bindParam(':email', $email);
                $stmt->execute();
    
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
                if (count($result) > 0) {
                    $id = $result[0]['idUsuario'];
                    return "./area-restrita/index-restrito-usuario.php?id=$id";
                }
            }
        }
    
        return false;
    }


    public function buscarUsuarioPorId($id) {
        $conexao = Conexao::conectar();

        $stmt = $conexao->prepare("SELECT * FROM tbUsuario WHERE idUsuario = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
    
 
    public function getIdUsuarioByEmail($email) {
        $conexao = Conexao::conectar(); 

        $stmt = $conexao->prepare("SELECT idUsuario FROM tbUsuario WHERE emailUsuario = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) > 0) {
            $id = $result[0]['idUsuario'];
            return $id;
        }

        return false;
    }

    public function alterar(){
        $conexao = Conexao::conectar();

        $stmt = $conexao->prepare("UPDATE tbUsuario SET nomeUsuario = ?, cpfUsuario = ?, dataNasc = ?,
                    sexoUsuario = ?, celUsuario = ?, emailUsuario = ? WHERE idUsuario = ?");
        $stmt->bindValue(1, $this->nomeUsuario);
        $stmt->bindValue(2, $this->cpfUsuario);
        $stmt->bindValue(3, $this->dataNasc);
        $stmt->bindValue(4, $this->sexoUsuario);
        $stmt->bindValue(5, $this->celUsuario);
        $stmt->bindValue(6, $this->emailUsuario);
        $stmt->bindValue(7, $this->idUsuario); // Adicione esta linha

        $stmt->execute();

        // Verificar se foi atualizado com sucesso
        if ($stmt->rowCount() > 0) {
            return "Dados alterados com sucesso.";
        } else {
            return "Erro ao alterar os dados.";
        } 
    }

    public function verificarExistenciaUsuario($cpf, $celular, $email) {
        $conexao = Conexao::conectar();
    
        $stmt = $conexao->prepare("SELECT * FROM tbUsuario WHERE cpfUsuario = :cpf OR celUsuario = :celular OR emailUsuario = :email");
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':celular', $celular);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        if (count($result) > 0) {
            return true; // Usuário já existe no banco de dados
        }
    
        return false; // Usuário não existe no banco de dados
    }
    
   

}
