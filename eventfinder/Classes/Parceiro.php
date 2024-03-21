<?php

require_once("Conexao.php");

class Parceiro {
    private $idParceiro;
    private $nomeParceiro;
    private $cnpjParceiro;
    private $celParceiro;
    private $emailParceiro;
    private $senhaParceiro;
    private $logradouro;
    private $numero;
    private $bairro;
    private $cidade;
    private $estado;
    private $cep;

    public function getIdParceiro() {
        return $this->idParceiro; 
    }

    public function getNomeParceiro() {
        return $this->nomeParceiro;
    }

    public function getCnpjParceiro() {
        return $this->cnpjParceiro;
    }

    public function getCelParceiro() {
        return $this->celParceiro;
    }

    public function getEmailParceiro() {
        return $this->emailParceiro;
    }

    public function getSenhaParceiro() {
        return $this->senhaParceiro;
    }

    public function getLogradouro() {
        return $this->logradouro;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function getBairro() {
        return $this->bairro;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getCep() {
        return $this->cep;
    }

    public function setIdParceiro($idParceiro) {
        $this->idParceiro = $idParceiro;
    }

    public function setNomeParceiro($nomeParceiro) {
        $this->nomeParceiro = $nomeParceiro;
    }

    public function setCnpjParceiro($cnpjParceiro) {
        $this->cnpjParceiro = $cnpjParceiro;
    }

    public function setCelParceiro($celParceiro) {
        $this->celParceiro = $celParceiro;
    }

    public function setEmailParceiro($emailParceiro) {
        $this->emailParceiro = $emailParceiro;
    }

    public function setSenhaParceiro($senhaParceiro) {
        $this->senhaParceiro = $senhaParceiro;
    }

    public function setLogradouro($logradouro) {
        $this->logradouro = $logradouro;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function setCep($cep) {
        $this->cep = $cep;
    }

    public function cadastrar($parceiro) {
        $conexao = Conexao::conectar();
        // Prepare statement
        $stmt = $conexao->prepare("INSERT INTO tbParceiro (nomeParceiro, cnpjParceiro, celParceiro, emailParceiro, senhaParceiro, logradouro, numero, bairro, cidade, estado, cep)
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bindValue(1, $parceiro->getNomeParceiro()); 
        $stmt->bindValue(2, $parceiro->getCnpjParceiro());
        $stmt->bindValue(3, $parceiro->getCelParceiro());
        $stmt->bindValue(4, $parceiro->getEmailParceiro());
        $stmt->bindValue(5, $parceiro->getSenhaParceiro());
        $stmt->bindValue(6, $parceiro->getLogradouro());
        $stmt->bindValue(7, $parceiro->getNumero());
        $stmt->bindValue(8, $parceiro->getBairro());
        $stmt->bindValue(9, $parceiro->getCidade());
        $stmt->bindValue(10, $parceiro->getEstado());
        $stmt->bindValue(11, $parceiro->getCep());

        $stmt->execute();
    }

    public function validarLogin($email, $senha) {
        $conexao = Conexao::conectar();
    
        $stmt = $conexao->prepare("SELECT senhaParceiro FROM tbParceiro WHERE emailParceiro = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        if (count($result) > 0) {
            $senhaCriptografada = $result[0]['senhaParceiro'];
            if (password_verify($senha, $senhaCriptografada)) {
                $stmt = $conexao->prepare("SELECT idParceiro FROM tbParceiro WHERE emailParceiro = :email");
                $stmt->bindParam(':email', $email);
                $stmt->execute();
    
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
                if (count($result) > 0) {
                    $id = $result[0]['idParceiro'];
                    return "./area-restrita/index-restrito-parceiro.php?id=$id";
                }
            }
        }
    
        return false;
    }
    
    public function buscaParceiroPorId($id) {
        $conexao = Conexao::conectar();

        $stmt = $conexao->prepare("SELECT * FROM tbParceiro WHERE idParceiro = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    } 
 
    public function getIdParceiroByEmail($email) {
        $conexao = Conexao::conectar();

        $stmt = $conexao->prepare("SELECT idParceiro FROM tbParceiro WHERE emailParceiro = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) > 0) {
            $id = $result[0]['idParceiro'];
            return $id;
        }

        return false;
    }

    

    public function alterar(){
        $conexao = Conexao::conectar();

        $stmt = $conexao->prepare("UPDATE tbParceiro SET nomeParceiro = ?, cnpjParceiro = ?, celParceiro = ?,
                    emailParceiro = ?, logradouro = ?, numero = ?, complemento = ?, bairro = ?, 
                    cidade = ?, estado = ?, cep = ? WHERE idParceiro = ?");
        $stmt->bindValue(1, $this->nomeParceiro);
        $stmt->bindValue(2, $this->cnpjParceiro);
        $stmt->bindValue(3, $this->celParceiro);
        $stmt->bindValue(4, $this->emailParceiro);
        $stmt->bindValue(5, $this->logradouro);
        $stmt->bindValue(6, $this->numero);
        $stmt->bindValue(7, $this->complemento); 
        $stmt->bindValue(8, $this->bairro);
        $stmt->bindValue(9, $this->cidade);
        $stmt->bindValue(10, $this->estado);
        $stmt->bindValue(11, $this->cep);
        $stmt->bindValue(12, $this->idParceiro);

        $stmt->execute();

        // Verificar se foi atualizado com sucesso
        if ($stmt->rowCount() > 0) {
            return "Dados alterados com sucesso.";
        } else {
            return "Erro ao alterar os dados.";
        }
    }
    
    

}

?>
