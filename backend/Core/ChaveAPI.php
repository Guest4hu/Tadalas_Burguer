<?php


namespace App\Tadala\Core;

class ChaveApi {
    private $chaveAPI;

    public function __construct() {
        $this->chaveAPI = $_ENV['API_KEY'];   
    }

    private function buscarChaveAPI(){
        $headers = getallheaders();
        $token = explode(" ", $headers['Authorization'])[1];
        return $token === $this->chaveAPI;
    }
    public function getChaveAPI(){
        if (!$this->buscarChaveAPI()) {
            self::buscarCabecalho(['error' => 'Acesso negado. Chave API inválida.'], 401);
            exit;
        }
    }



    public static function buscarCabecalho(array $data = [], int $status = 200){
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }
    public static function CabecalhoDecode(){
        $dados = json_decode(file_get_contents("php://input"), true);
        return $dados;
    }
}