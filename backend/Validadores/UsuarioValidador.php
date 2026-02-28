<?php
namespace App\Tadala\Validadores;
class UsuarioValidador{
    public static function ValidarEntradas($dados){
        $erros = [];
        if(isset($dados['nome']) && empty($dados['nome'])){
            $erros[] = "O campo nome é obrigatório.";
        }

        if(isset($dados['email']) && empty($dados['email'])){
            $erros[] = "O campo email é obrigatório.";
        } elseif(!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)){
            $erros[] = "O campo email deve ser um endereço de email válido.";
        }

        if(isset($dados['telefone']) && empty($dados['telefone'])){
            $erros[] = "O campo telefone é obrigatório.";
        }

        if(isset($dados['senha']) && empty($dados['senha'])){
            $erros[] = "O campo senha é obrigatório.";
        } elseif(strlen($dados['senha']) < 6){
            $erros[] = "O campo senha deve ter pelo menos 6 caracteres.";
        }
        
        return $erros;
    }
}