<?php
namespace App\Tadala\Controllers\API;

use App\Tadala\Database\Database;
use App\Tadala\Models\Cargo;
use App\Tadala\Core\ChaveApi;

class APICargoController {

    public $Cargo;
    private $ChaveApi;
    private $db;

    public function __construct()
    {
        $this->ChaveApi = new ChaveApi($this->db);
        $this->ChaveApi->getChaveAPI();
        $this->db = Database::getInstance();
        $this->Cargo = new Cargo($this->db);
    }

    public function deletarCargo()
      {
            $dados = json_decode(file_get_contents("php://input"),true);
            $idCargo = $dados['id'];
             $this->Cargo->deletarCargo($idCargo);
             ChaveApi::buscarCabecalho([
                "status" => "sucesso",
                "message" => "Cargo deletado com sucesso!"
            ], 200);
       }
}
