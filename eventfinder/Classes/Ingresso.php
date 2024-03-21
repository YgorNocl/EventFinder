<?php
require_once("Usuario.php");
require_once("Conexao.php");


class Ingresso {
    private $idIngresso;
    private $idEvento;
    private $quantidadeCamarote;
    private $quantidadePista;
    private $valorCamarote;
    private $valorPista;
    private $valorTotal;
    private $dataCompra;
    private $idUsuario;

    public function getIdIngresso() {
        return $this->idIngresso;
    }

    public function getIdEvento() {
        return $this->idEvento;
    }

    public function getQuantidadeCamarote() {
        return $this->quantidadeCamarote;
    }

    public function getQuantidadePista() {
        return $this->quantidadePista;
    }

    public function getValorCamarote() {
        return $this->valorCamarote;
    }

    public function getValorPista() {
        return $this->valorPista;
    }

    public function getValorTotal() {
        return $this->valorTotal;
    }

    public function getDataCompra() {
        return $this->dataCompra;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function setIdIngresso($idIngresso) {
        $this->idIngresso = $idIngresso;
    }

    public function setIdEvento($idEvento) {
        $this->idEvento = $idEvento;
    }

    public function setQuantidadeCamarote($quantidadeCamarote) {
        $this->quantidadeCamarote = $quantidadeCamarote;
    }

    public function setQuantidadePista($quantidadePista) {
        $this->quantidadePista = $quantidadePista;
    }

    public function setValorCamarote($valorCamarote) {
        $this->valorCamarote = $valorCamarote;
    }

    public function setValorPista($valorPista) {
        $this->valorPista = $valorPista;
    }

    public function setValorTotal($valorTotal) {
        $this->valorTotal = $valorTotal;
    }

    public function setDataCompra($dataCompra) {
        $this->dataCompra = $dataCompra;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }
    
    public function verificarIngressoExistente($idEvento, $idUsuario)
{
    $conexao = new Conexao();
    $conn = $conexao->conectar();

    $sql = "SELECT * FROM tbingresso WHERE idEvento = :idEvento AND idUsuario = :idUsuario";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idEvento', $idEvento, PDO::PARAM_INT);
    $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
    $stmt->execute();

    $dados = $stmt->fetch(PDO::FETCH_ASSOC);

    return $dados;
}

    
    

    public function cadastrarIngresso($ingresso) {
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare("INSERT INTO tbingresso (idEvento, quantidadeCamarote, quantidadePista, valorCamarote, valorPista, valorTotal, dataCompra, idUsuario)
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bindValue(1, $ingresso->getIdEvento());
        $stmt->bindValue(2, $ingresso->getQuantidadeCamarote());
        $stmt->bindValue(3, $ingresso->getQuantidadePista());
        $stmt->bindValue(4, $ingresso->getValorCamarote());
        $stmt->bindValue(5, $ingresso->getValorPista());
        $stmt->bindValue(6, $ingresso->getValorTotal());
        $stmt->bindValue(7, $ingresso->getDataCompra());
        $stmt->bindValue(8, $ingresso->getIdUsuario());
    
        $stmt->execute();
    
        
    }
    

    public function buscarIngressoPorIdUsuario($idUsuario) {
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare("SELECT * FROM tbIngresso WHERE idUsuario = ?");
        $stmt->bindValue(1, $idUsuario);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Dentro da classe Ingresso

    public function buscarIngressoEvento($idUsuario, $idEvento) {
    $conexao = Conexao::conectar();
    $stmt = $conexao->prepare("SELECT * FROM tbIngresso WHERE idUsuario = ? AND idEvento = ?");
    $stmt->bindValue(1, $idUsuario);
    $stmt->bindValue(2, $idEvento);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function contarIngressosPorEvento($idEvento) {
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare("SELECT SUM(quantidadeCamarote) AS totalCamarote, SUM(quantidadePista) AS totalPista FROM tbingresso WHERE idEvento = ?");
        $stmt->bindValue(1, $idEvento);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $quantidadeCamarote = $result['totalCamarote'];
        $quantidadePista = $result['totalPista'];

        return array('camarote' => $quantidadeCamarote, 'pista' => $quantidadePista);
    }

    
    
    
}
?>
