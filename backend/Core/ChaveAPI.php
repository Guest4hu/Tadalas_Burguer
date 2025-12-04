<?php


namespace App\Tadala\Core;

class ChaveApi {
    private $chaveAPI;

    public function __construct() {
      $this->chaveAPI = "5d242b5294d72df332ca2c492d2c0b9b";   
    }

    private function buscarChaveAPI(){
        $headers = getallheaders();
        $token = explode(" ", $headers['Authorization'])[1];
        return $token === $this->chaveAPI;
    }
    public function getChaveAPI(){
        if (!$this->buscarChaveAPI()) {
            header('Content-Type: application/json');
            http_response_code(401);
            echo json_encode([
                'status' => 'error',
                'message' => 'Acesso não autorizado. Chave API inválida.'
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
            exit;
        }
    }
}