<?php



namespace App\Tadala\Controllers\API;
use App\Tadala\Core\Redirect;
use App\Tadala\Database\Database;
use App\Tadala\Models\Categoria;
use App\Tadala\Core\ChaveApi;

class APICategoriaController {

    public $Categoria;
    private $ChaveApi;
    private $db;

    public function __construct()
    {
        $this->ChaveApi = new ChaveApi();
        $this->ChaveApi->getChaveAPI();
        $this->db = Database::getInstance();
        $this->Categoria = new Categoria($this->db);
    }

    public function deletarCategoria()
      {
            $dados = json_decode(file_get_contents("php://input"),true);
            $idCategoria = $dados['id'];
             $this->Categoria->excluirCategoria($idCategoria);
             ChaveApi::buscarCabecalho([
                "status" => "sucesso",
                "message" => "Categoria deletada com sucesso!"
            ], 200);
       }
}





