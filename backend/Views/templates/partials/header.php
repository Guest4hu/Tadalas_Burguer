<!DOCTYPE html>
<html>
<head>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
</head>
<body class="w3-light-grey">

<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
  <span class="w3-bar-item w3-right">Logo</span>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
      <img src="/w3images/avatar2.png" class="w3-circle w3-margin-right" style="width:46px">
    </div>
    <div class="w3-col s8 w3-bar">
      <span>Welcome, <strong>Mike</strong></span><br>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i></a>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-user"></i></a>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-cog"></i></a>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Dashboard</h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="/backend/usuario" class="w3-bar-item w3-button w3-padding "><i class="fa fa-users fa-fw"></i>  Usuarios</a>
    <a href="/backend/cargo" class="w3-bar-item w3-button w3-padding "><i class="fa fa-users fa-fw"></i>  Cargos</a>
    <a href="/backend/statusFuncionario" class="w3-bar-item w3-button w3-padding "><i class="fa fa-users fa-fw"></i>  Status dos Funcionario</a>
    <a href="/backend/statusPagamento" class="w3-bar-item w3-button w3-padding "><i class="fa fa-users fa-fw"></i>  Status dos Pagamento</a>
    <a href="/backend/statusPedido" class="w3-bar-item w3-button w3-padding "><i class="fa fa-users fa-fw"></i>  Status dos pedidos</a>
    <a href="/backend/tipoUsuario" class="w3-bar-item w3-button w3-padding "><i class="fa fa-users fa-fw"></i>  Tipos de Usuarios</a>
    <a href="/backend/agendamentos" class="w3-bar-item w3-button w3-padding "><i class="fa fa-users fa-fw"></i>  Agendamentos</a>
    <a href="/backend/categoria" class="w3-bar-item w3-button w3-padding "><i class="fa fa-users fa-fw"></i>  Categorias</a>
    <a href="/backend/endereco" class="w3-bar-item w3-button w3-padding "><i class="fa fa-users fa-fw"></i>  Endereco</a>
    <a href="/backend/funcionarios" class="w3-bar-item w3-button w3-padding "><i class="fa fa-users fa-fw"></i>  Funcionarios</a>
    <a href="/backend/itensPedidos" class="w3-bar-item w3-button w3-padding "><i class="fa fa-users fa-fw"></i>  Itens Pedidos</a>
    <a href="/backend/pagamento" class="w3-bar-item w3-button w3-padding "><i class="fa fa-users fa-fw"></i>  Pagamento</a>
    <a href="/backend/pedidos" class="w3-bar-item w3-button w3-padding "><i class="fa fa-users fa-fw"></i>  Pedidos</a>
    <a href="/backend/produtos" class="w3-bar-item w3-button w3-padding "><i class="fa fa-users fa-fw"></i>  Produtos</a>
    <a href="/backend/promocoes" class="w3-bar-item w3-button w3-padding "><i class="fa fa-users fa-fw"></i>  Promoçoes</a>
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">
    <?php
use App\Tadala\Core\Flash;
$mensagem = Flash::getAll();
if(isset($mensagem)){
   foreach($mensagem as $key => $value){
        if($key == "type"){
            $tipo = $value == "success" ? "alert-success" : "alert-danger";
            echo "<div class='alert $tipo' role='alert'>";
        }else{
            echo $value;
            echo "</div>";
        }
   }
}

?>