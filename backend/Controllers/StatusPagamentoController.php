<?php
namespace Controllers;
use Models\StatusPagamento;

class StatusPagamentoController {
    private $statusPagamento;

    public function __construct($db){
        $this->statusPagamento = new StatusPagamento($db);
    }

    public function listar(){
        $resultado = ($this->statusPagamento->buscarTodos());
        var_dump($resultado);
    }

    public function mostrar($id){
        $resultado = ($this->statusPagamento->buscarPorId($id));
        var_dump($resultado);
    }

    public function criar($descricao){
        $resultado = $this->statusPagamento->inserir($descricao);
        var_dump($resultado);
    }

    public function atualizar($id, $descricao){
        $resultado = $this->statusPagamento->atualizar($id, $descricao);
        var_dump($resultado);
    }
}
?>
