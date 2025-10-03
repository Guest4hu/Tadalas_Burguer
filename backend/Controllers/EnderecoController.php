<?php 
namespace Controllers;
use Models\Endereco;
class EnderecoController{

    private $endereco;

    function __construct($db){
    $this->endereco = new Endereco($db);}


    function listar($id){
        $result = ($this->endereco->buscarPorId($id));
        var_dump($result[0]);
    }
    function buscarTodos()
    {
        $result = ($this->endereco->buscarTodos());
        var_dump($result);
    }
    function inserir($rua, $numero, $complemento, $bairro, $cidade, $estado, $cep, $usuario_id){
        $result = ($this->endereco->inserir($rua, $numero, $complemento, $bairro, $cidade, $estado, $cep, $usuario_id));
        var_dump($result);
    }
    function atualizar($id, $rua, $numero, $complemento, $bairro, $cidade, $estado, $cep){
        $result = ($this->endereco->atualizar($id, $rua, $numero, $complemento, $bairro, $cidade, $estado, $cep));
        var_dump($result);
    }
    
}