<?php  

include_once __DIR__.'/../Database/database.php';
class Produtos {
    private $produtos_id;
    private $nome;
    private $descricao;
    private $preco;
    private $estoque;
    private $categoria_id;
    private $db;
    public function __construct($db){
        $this->db = $db;
    }
    function buscaProdutos(){
      $sql = 'SELECT produtos_id as "ID", nome as "Nome", descricao as "Descrição", preco as "Preço", estoque as "Estoque", categoria_id as "Categoria" FROM tbl_produtos';
      $stmt = $this->db->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}