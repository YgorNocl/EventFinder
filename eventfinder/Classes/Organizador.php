<?php

    require_once("Conexao.php");

    class Organizador {
        private $idOrganizador;
        private $nomeOrganizador;
        private $docOrganizador;
        private $dataNasc;
        private $sexoOrganizador;
        private $celOrganizador;
        private $emailOrganizador;
        private $senhaOrganizador;
    
        public function getIdOrganizador() {
            return $this->idOrganizador;
        }
    
        public function getNomeOrganizador() {
            return $this->nomeOrganizador;
        }
    
        public function getDocOrganizador() {
            return $this->docOrganizador;
        }
    
        public function getDataNasc() {
            return $this->dataNasc;
        }
    
        public function getSexoOrganizador() {
            return $this->sexoOrganizador;
        }
    
        public function getCelOrganizador() {
            return $this->celOrganizador;
        }
    
        public function getEmailOrganizador() {
            return $this->emailOrganizador;
        }
    
        public function getSenhaOrganizador() {
            return $this->senhaOrganizador;
        }
    
        public function setIdOrganizador($idOrganizador) {
            $this->idOrganizador = $idOrganizador;
        }
    
        public function setNomeOrganizador($nomeOrganizador) {
            $this->nomeOrganizador = $nomeOrganizador;
        }
    
        public function setDocOrganizador($docOrganizador) {
            $this->docOrganizador = $docOrganizador;
        }
    
        public function setDataNasc($dataNasc) {
            $this->dataNasc = $dataNasc;
        }
    
        public function setSexoOrganizador($sexoOrganizador) {
            $this->sexoOrganizador = $sexoOrganizador;
        }
    
        public function setCelOrganizador($celOrganizador) {
            $this->celOrganizador = $celOrganizador;
        }
    
        public function setEmailOrganizador($emailOrganizador) {
            $this->emailOrganizador = $emailOrganizador;
        }
    
        public function setSenhaOrganizador($senhaOrganizador) {
            $this->senhaOrganizador = $senhaOrganizador;
        }

        public function cadastrar($organizador) {
            $conexao = Conexao::conectar();
            //prepare statement
            $stmt = $conexao->prepare("INSERT INTO tbOrganizador (nomeOrganizador, docOrganizador, dataNasc, sexoOrganizador, celOrganizador, emailOrganizador, senhaOrganizador)
                                        VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bindValue(1, $organizador->getNomeOrganizador()); 
            $stmt->bindValue(2, $organizador->getDocOrganizador());
            $stmt->bindValue(3, $organizador->getDataNasc());
            $stmt->bindValue(4, $organizador->getSexoOrganizador());
            $stmt->bindValue(5, $organizador->getCelOrganizador());
            $stmt->bindValue(6, $organizador->getEmailOrganizador());
            $stmt->bindValue(7, $organizador->getSenhaOrganizador());
        
            $stmt->execute();
        
            // return "Cadastro realizado com sucesso";
        }
        
        public function validarLogin($email, $senha) {
            $conexao = Conexao::conectar();
        
            $stmt = $conexao->prepare("SELECT senhaOrganizador FROM tbOrganizador WHERE emailOrganizador = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
        
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            if (count($result) > 0) {
                $senhaCriptografada = $result[0]['senhaOrganizador'];
                if (password_verify($senha, $senhaCriptografada)) {
                    $stmt = $conexao->prepare("SELECT idOrganizador FROM tbOrganizador WHERE emailOrganizador = :email");
                    $stmt->bindParam(':email', $email);
                    $stmt->execute();
        
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
                    if (count($result) > 0) {
                        $id = $result[0]['idOrganizador'];
                        return "./area-restrita/index-restrito-organizador.php?id=$id";
                    }
                }
            }
        
            return false;
        }

        public function buscarOrganizadorPorId($id) {
        $conexao = Conexao::conectar();

        $stmt = $conexao->prepare("SELECT * FROM tbOrganizador WHERE idOrganizador = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
  
    public function getIdOrganizadorByEmail($email) {
        $conexao = Conexao::conectar();

        $stmt = $conexao->prepare("SELECT idOrganizador FROM tbOrganizador WHERE emailOrganizador = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) > 0) {
            $id = $result[0]['idOrganizador'];
            return $id;
        }

        return false;
    }

    public function alterar(){
        $conexao = Conexao::conectar();

        $stmt = $conexao->prepare("UPDATE tbOrganizador SET nomeOrganizador = ?, docOrganizador = ?, dataNasc = ?,
                    sexoOrganizador = ?, celOrganizador = ?, emailOrganizador = ? WHERE idOrganizador = ?");
        $stmt->bindValue(1, $this->nomeOrganizador);
        $stmt->bindValue(2, $this->docOrganizador);
        $stmt->bindValue(3, $this->dataNasc);
        $stmt->bindValue(4, $this->sexoOrganizador);
        $stmt->bindValue(5, $this->celOrganizador);
        $stmt->bindValue(6, $this->emailOrganizador);
        $stmt->bindValue(7, $this->idOrganizador); // Adicione esta linha

        $stmt->execute();

        // Verificar se foi atualizado com sucesso
        if ($stmt->rowCount() > 0) {
            return "Dados alterados com sucesso.";
        } else {
            return "Erro ao alterar os dados.";
        }
    }

    public function contarEventosCadastrados($idOrganizador) {
        $conexao = Conexao::conectar();
    
        $stmt = $conexao->prepare("SELECT COUNT(*) AS totalEventos FROM tbEvento WHERE idOrganizador = ?");
        $stmt->bindValue(1, $idOrganizador);
        $stmt->execute();
    
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $resultado['totalEventos'];
    }

    public function contarEventosCadastradosPorTipo($idOrganizador)
    {
        $conexao = Conexao::conectar();
    
        $stmt = $conexao->prepare("SELECT tipoEvento, COUNT(*) AS totalEventos FROM tbEvento WHERE idOrganizador = ? GROUP BY tipoEvento");
        $stmt->bindValue(1, $idOrganizador);
        $stmt->execute();
    
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $resultados;
    }
    

        
    public function contarIngressosEvento($idEvento) {
        $conexao = Conexao::conectar();
    
        $stmt = $conexao->prepare("SELECT SUM(quantidadeCamarote + quantidadePista) AS totalIngressosVendidos
                                    FROM tbIngresso AS i
                                    JOIN tbEvento AS e ON i.idEvento = e.idEvento
                                    WHERE e.idOrganizador = ?");
        $stmt->bindValue(1, $idEvento);
        $stmt->execute();
    
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Verifica se há algum resultado retornado
        if ($resultado && isset($resultado['totalIngressosVendidos'])) {
            return $resultado['totalIngressosVendidos'];
        } else {
            return 0; // Retorna 0 se nenhum ingresso for encontrado
        }
    }
    
 
    public function buscarIngressosVendidos($idOrganizador)
{
    $conexao = Conexao::conectar();

    $stmt = $conexao->prepare("SELECT SUM(quantidadeCamarote) AS totalCamarote, SUM(quantidadePista) AS totalPista 
                              FROM tbIngresso AS i
                              JOIN tbEvento AS e ON i.idEvento = e.idEvento
                              WHERE e.idOrganizador = :idOrganizador");
    $stmt->bindParam(':idOrganizador', $idOrganizador);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
    


    public function verificarExistenciaOrganizador($documento, $celular, $email) {
        $conexao = Conexao::conectar();
     
        $stmt = $conexao->prepare("SELECT * FROM tbOrganizador WHERE docOrganizador = :documento OR celOrganizador = :celular OR emailOrganizador = :email");
        $stmt->bindParam(':documento', $documento);
        $stmt->bindParam(':celular', $celular);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
     
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        if (count($result) > 0) {
            return true; // Usuário já existe no banco de dados
        }
    
        return false; // Usuário não existe no banco de dados
    }
    
    public function calcularValorTotalIngressosVendidos($idOrganizador) {
        $conexao = Conexao::conectar();
    
        $stmt = $conexao->prepare("SELECT SUM(valorTotal) AS valorTotalIngressosVendidos
                                  FROM tbingresso AS i
                                  JOIN tbevento AS e ON i.idEvento = e.idEvento
                                  WHERE e.idOrganizador = ?");
        $stmt->bindValue(1, $idOrganizador);
        $stmt->execute();
    
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Verifica se há algum resultado retornado
        if ($resultado && isset($resultado['valorTotalIngressosVendidos'])) {
            return $resultado['valorTotalIngressosVendidos'];
        } else {
            return 0; // Retorna 0 se nenhum ingresso for encontrado
        }
    }
    
    public function ValorTotalIngressosCamarote($idOrganizador) {
        $conexao = Conexao::conectar();
    
        $stmt = $conexao->prepare("SELECT SUM(valorCamarote) AS valorTotalIngressosCamarote
                                  FROM tbingresso AS i
                                  JOIN tbevento AS e ON i.idEvento = e.idEvento
                                  WHERE e.idOrganizador = ?");
        $stmt->bindValue(1, $idOrganizador);
        $stmt->execute();
    
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Verifica se há algum resultado retornado
        if ($resultado && isset($resultado['valorTotalIngressosCamarote'])) {
            return $resultado['valorTotalIngressosCamarote'];
        } else {
            return 0; // Retorna 0 se nenhum ingresso for encontrado
        }
    }

    public function ValorTotalIngressosPista($idOrganizador) {
        $conexao = Conexao::conectar();
    
        $stmt = $conexao->prepare("SELECT SUM(valorPista) AS valorTotalIngressosPista
                                  FROM tbingresso AS i
                                  JOIN tbevento AS e ON i.idEvento = e.idEvento
                                  WHERE e.idOrganizador = ?");
        $stmt->bindValue(1, $idOrganizador);
        $stmt->execute();
    
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Verifica se há algum resultado retornado
        if ($resultado && isset($resultado['valorTotalIngressosPista'])) {
            return $resultado['valorTotalIngressosPista'];
        } else {
            return 0; // Retorna 0 se nenhum ingresso for encontrado
        }
    }

       }
        
       
    
?>