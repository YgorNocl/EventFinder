<?php

require_once("Conexao.php");

class Evento {
    private $idEvento;
    private $descEvento;
    private $tipoEvento;
    private $fotoEvento;
    private $idadeMinima;
    private $precoCamarote;
    private $precoPista;
    private $localEvento;
    private $dataEvento;
    private $horaEvento;
    private $horaAberturaEvento;
    private $idOrganizador;

    public function getIdEvento() {
        return $this->idEvento;
    }

    public function getDescEvento() {
        return $this->descEvento;
    }

    public function getTipoEvento() {
        return $this->tipoEvento;
    }

    public function getFotoEvento() {
        return $this->fotoEvento;
    }

    public function getIdadeMinima() {
        return $this->idadeMinima;
    }

    public function getPrecoCamarote() {
        return $this->precoCamarote;
    }

    public function getPrecoPista() {
        return $this->precoPista;
    }

    public function getLocalEvento() {
        return $this->localEvento;
    }

    public function getDataEvento() {
        return $this->dataEvento;
    }

    public function getHoraEvento() {
        return $this->horaEvento;
    }

    public function getHoraAberturaEvento() {
        return $this->horaAberturaEvento;
    }

    public function getIdOrganizador() {
        return $this->idOrganizador;
    }


    public function setIdEvento($idEvento) {
        $this->idEvento = $idEvento;
    }

    public function setDescEvento($descEvento) {
        $this->descEvento = $descEvento;
    }

    public function setTipoEvento($tipoEvento) {
        $this->tipoEvento = $tipoEvento;
    }

    public function setFotoEvento($fotoEvento) {
        $this->fotoEvento = $fotoEvento;
    }

    public function setIdadeMinima($idadeMinima) {
        $this->idadeMinima = $idadeMinima;
    }

    public function setPrecoCamarote($precoCamarote) {
        $this->precoCamarote = $precoCamarote;
    }

    public function setPrecoPista($precoPista) {
        $this->precoPista = $precoPista;
    }

    public function setLocalEvento($localEvento) {
        $this->localEvento = $localEvento;
    }

    public function setDataEvento($dataEvento) {
        $this->dataEvento = $dataEvento;
    }

    public function setHoraEvento($horaEvento) {
        $this->horaEvento = $horaEvento;
    }

    public function setHoraAberturaEvento($horaAberturaEvento) {
        $this->horaAberturaEvento = $horaAberturaEvento;
    }

    public function setIdOrganizador($idOrganizador) {
        $this->idOrganizador = $idOrganizador;
    }

    public function cadastrarEvento($evento) {
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare("INSERT INTO tbEvento (descEvento, tipoEvento, fotoEvento, idadeMinima, precoCamarote, precoPista, localEvento, dataEvento, horaEvento, horaAberturaEvento, idOrganizador)
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bindValue(1, $evento->getDescEvento());
        $stmt->bindValue(2, $evento->getTipoEvento());
        $stmt->bindValue(3, $evento->getFotoEvento());
        $stmt->bindValue(4, $evento->getIdadeMinima());
        $stmt->bindValue(5, $evento->getPrecoCamarote());
        $stmt->bindValue(6, $evento->getPrecoPista());
        $stmt->bindValue(7, $evento->getLocalEvento());
        $stmt->bindValue(8, $evento->getDataEvento());
        $stmt->bindValue(9, $evento->getHoraEvento());
        $stmt->bindValue(10, $evento->getHoraAberturaEvento());
        $stmt->bindValue(11, $evento->getIdOrganizador());

        $stmt->execute();
    }

    public function listar(){
        $conexao = Conexao::conectar();
        $idOrganizador = $this->getIdOrganizador(); // Obtém o ID do organizador
    
        $querySelect = "SELECT idEvento, descEvento, tipoEvento, fotoEvento, idadeMinima, precoCamarote, precoPista, localEvento, dataEvento, horaEvento, horaAberturaEvento FROM tbEvento WHERE idOrganizador = ?";
        
        $stmt = $conexao->prepare($querySelect);
        $stmt->bindValue(1, $idOrganizador);
        $stmt->execute();
    
        $lista = $stmt->fetchAll();
        return $lista;
    }

    public function listarTudo(){
        $conexao = Conexao::conectar();
    
        $querySelect = "SELECT idEvento, descEvento, tipoEvento, fotoEvento, idadeMinima, precoCamarote, precoPista, localEvento, dataEvento, horaEvento, horaAberturaEvento FROM tbEvento";
        
        $stmt = $conexao->prepare($querySelect);
        $stmt->execute();
    
        $lista = $stmt->fetchAll();
        return $lista;
    }

    public function deletar($idEvento){
        $conexao = Conexao::conectar();

        $stmt = $conexao->prepare("DELETE FROM tbEvento WHERE idEvento = ?");
        $stmt->bindValue(1, $idEvento);
        $stmt->execute();

        // verificar se foi deletado com sucesso
        if ($stmt->rowCount() > 0) {
            return "Evento deletado com sucesso.";
        } else {
            return "Erro ao deletar o evento.";
        }
    }

    public function alterar(){
    $conexao = Conexao::conectar();

    $stmt = $conexao->prepare("UPDATE tbEvento SET descEvento = ?, tipoEvento = ?, fotoEvento = ?, idadeMinima = ?, precoCamarote = ?, precoPista = ?, localEvento = ?, dataEvento = ?, horaEvento = ?, horaAberturaEvento = ? WHERE idEvento = ?");
    $stmt->bindValue(1, $this->descEvento);
    $stmt->bindValue(2, $this->tipoEvento);
    $stmt->bindValue(3, $this->fotoEvento);
    $stmt->bindValue(4, $this->idadeMinima);
    $stmt->bindValue(5, $this->precoCamarote);
    $stmt->bindValue(6, $this->precoPista);
    $stmt->bindValue(7, $this->localEvento);
    $stmt->bindValue(8, $this->dataEvento);
    $stmt->bindValue(9, $this->horaEvento);
    $stmt->bindValue(10, $this->horaAberturaEvento);
    $stmt->bindValue(11, $this->idEvento);

    $stmt->execute();

    // Verificar se foi atualizado com sucesso
    if ($stmt->rowCount() > 0) {
        return "Evento alterado com sucesso.";
    } else {
        return "Erro ao alterar o evento.";
    }
}

public function buscarPorId(){
    $conexao = Conexao::conectar();

    $stmt = $conexao->prepare("SELECT * FROM tbEvento WHERE idEvento = ?");
    $stmt->bindValue(1, $this->idEvento);
    $stmt->execute();

    $dadosEvento = $stmt->fetch(PDO::FETCH_ASSOC);

    return $dadosEvento;
}

public function pesquisarEventos($termoPesquisa) {
    // Conectar ao banco de dados
    $conexao = new Conexao();
    $db = $conexao->conectar();

    // Preparar a consulta SQL
    $stmt = $db->prepare("SELECT * FROM tbEvento WHERE descEvento LIKE :termo OR tipoEvento LIKE :termo");
    $termoPesquisa = "%{$termoPesquisa}%";
    $stmt->bindParam(':termo', $termoPesquisa);
    $stmt->execute();

    // Obter os resultados da consulta
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Retornar os resultados
    return $resultados;
}




}
?>


