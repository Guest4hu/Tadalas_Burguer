<?php 
namespace App\Tadala\Controllers;

use App\Tadala\Core\View;
use app\tadala\Models\Endereco;
class EnderecoController{

    private $endereco;

    function __construct($db){
    $this->endereco = new Endereco($db);}


    function viewListarEndereco($id){
        $result = ($this->endereco->buscarPorId($id));
        var_dump($result[0]);
    }
    function buscarTodos()
    {
        $result = ($this->endereco->buscarTodos());
        var_dump($result);
    }
    function viewCriarEndereco(){
        // $result = ($this->endereco->inserir($rua, $numero, $complemento, $bairro, $cidade, $estado, $cep, $usuario_id));
        // var_dump($result);
        View::render("endereco/create");
    }
    function atualizar($id, $rua, $numero, $complemento, $bairro, $cidade, $estado, $cep){
        $result = ($this->endereco->atualizar($id, $rua, $numero, $complemento, $bairro, $cidade, $estado, $cep));
        var_dump($result);
    }
    
}