<?php

use App\Tadala\Core\Flash;
use App\Tadala\Core\Session;

// Toda parte da URL que vem depois do domínio (localhost:8000)
$uriPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);

/**
 *    NÍVEIS DE ACESSO
 *    1 = Apenas administrador
 *    2 = Administrador e funcionário
 */

$menu = [
  1   =>  [ 2,  [ 'href'  =>  '/backend/cliente',         'label' => 'Clientes',        'icon' => 'fa-users'        ] ],
  2   =>  [ 1,  [ 'href'  =>  '/backend/cargo',           'label' => 'Cargos',          'icon' => 'fa-briefcase'    ] ],
  3   =>  [ 2,  [ 'href'  =>  '/backend/agendamento',     'label' => 'Agendamentos',    'icon' => 'fa-calendar'     ] ],
  4   =>  [ 1,  [ 'href'  =>  '/backend/categoria',       'label' => 'Categorias',      'icon' => 'fa-tags'         ] ],
  5   =>  [ 1,  [ 'href'  =>  '/backend/funcionarios',    'label' => 'Funcionários',    'icon' => 'fa-address-book' ] ],
  6   =>  [ 2,  [ 'href'  =>  '/backend/produtos',        'label' => 'Produtos',        'icon' => 'fa-cubes'        ] ],
  7   =>  [ 1,  [ 'href'  =>  '/backend/promocoes',       'label' => 'Promoções',       'icon' => 'fa-bullhorn'     ] ]
];

$menudrop = [
  ['href' => '/backend/analises/pedidos', 'label' => 'Analises de Pedidos', 'icon' => 'fa-shopping-basket'],
  ['href' => '/backend/analises/produtos', 'label' => 'Analises de Estoque', 'icon' => 'fa-cubes'],
  ['href' => '/backend/analises/vendas', 'label' => 'Analises de Vendas', 'icon' => 'fa-money'],
];

// Helpers
$e = fn($v) => htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');

// Configura a opção como ativa se o href for igual à rota atual
$isActive = function (string $current, string $href): bool {
  if ($href === '/') return $current === '/';
  return strpos($current, $href) === 0;
};


$session = new Session();

$tipoUsuario = $session->get('usuario_tipo_id') ?? '';



?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <title>Tadala’s Burguer - Painel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#111">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:300,400,600">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    :root {
      --sidebar-width: 300px;
    }

    html,
    body,
    h1,
    h2,
    h3,
    h4,
    h5 {
      font-family: "Raleway", sans-serif;
    }

    .brand {
      letter-spacing: .5px;
    }

    .sidebar-avatar {
      width: 46px;
      height: 46px;
      border-radius: 50%;
      object-fit: cover;
    }

    .w3-sidebar {
      width: var(--sidebar-width) !important;
    }

    .w3-main {
      margin-left: var(--sidebar-width);
    }

    @media (max-width: 992px) {
      .w3-main {
        margin-left: 0 !important;
      }
    }

    .menu-link {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .menu-link .fa {
      width: 20px;
      text-align: center;
    }

    .menu-item-active {
      font-weight: 600;
    }

    .topbar {
      z-index: 4;
    }

    .flash-close {
      cursor: pointer;
    }
  </style>
</head>

<body class="w3-light-grey">


  <?php
  $nomeUsuario = $session->get('usuario_nome') ?? 'Usuário';
  if ($session->has('usuario_id')):
  ?>


    <!-- Topbar -->
    <div class="w3-bar w3-top w3-black w3-large topbar">
      <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open()" aria-label="Abrir menu">
        <i class="fa fa-bars"></i> Menu
      </button>
      <a href="/backend" class="w3-bar-item w3-right brand w3-hover-none w3-text-white" style="text-decoration:none">
        <i class="fa fa-cutlery" aria-hidden="true"></i> Tadala’s Burguer
      </a>
    </div>

    <!-- Sidebar -->
    <nav class="w3-sidebar w3-collapse w3-white w3-animate-left" id="mySidebar" aria-label="Menu lateral"><br>
      <div class="w3-container w3-row">
        <div class="w3-col s4">
          <img
            class="sidebar-avatar w3-margin-right"
            alt="Avatar"
            src="https://ui-avatars.com/api/?name=<?= urlencode($nomeUsuario) ?>&background=111&color=fff&size=92&bold=true">
        </div>
        <div class="w3-col s8 w3-bar">
          <span>Bem-vindo(a), <strong><?= $e($nomeUsuario) ?></strong></span><br>
          <!-- <a href="/backend/configuracao" class="w3-bar-item w3-button" title="Configurações"><i class="fa fa-cog"></i></a> -->
        </div>
      </div>
      <hr>
      <div class="w3-container">
        <a href="/backend/admin/dashboard" class="'w3-bar-item w3-button w3-padding menu-link">
          <h5 class="w3-opacity"><i class="fa fa-dashboard"></i> Dashboard</h5>
        </a>
      </div>

      <div class="w3-bar-block">
        <a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="Fechar menu">
          <i class="fa fa-remove fa-fw"></i> Fechar Menu
        </a>

        <?php
        foreach ($menu as $option):
          $accessLevel  = $option[0];
          $item         = $option[1];

          if($accessLevel >= $tipoUsuario):
            $active = $isActive($uriPath, $item['href']);
            $classes = 'w3-bar-item w3-button w3-padding menu-link';
            if ($active) $classes .= ' w3-blue menu-item-active'; // Se $isActive devolver 1, a opção recebe a classe de ativo do css
        ?>
          <a href="<?= $e($item['href']) ?>" class="<?= $e($classes) ?>">
            <i class="fa <?= $e($item['icon']) ?> fa-fw" aria-hidden="true"></i>
            <span><?= $e($item['label']) ?></span>
          </a>
        <?php
          endif;
        endforeach;
        ?>

        <!-- Dropdown Analises
  <div class="w3-dropdown-hover w3-bar-block" style="margin-top:8px;">
    <button class="w3-button w3-block w3-padding menu-link">
      <i class="fa fa-angle-down fa-fw"><i class="fa-line-chart"></i></i>
      Analises
    </button>
    <div class="w3-dropdown-content w3-bar-block w3-card-4">
      <?php foreach ($menudrop as $item): ?>
        <a href="<?= $e($item['href']) ?>" class="w3-bar-item w3-button">
          <i class="fa <?= $e($item['icon']) ?> fa-fw" aria-hidden="true"></i>
          <span><?= $e($item['label']) ?></span>
        </a>
      <?php endforeach; ?>
    </div>
  </div> -->

        <!-- Dropdown Pedidos -->
        <div class="w3-dropdown-hover w3-bar-block" style="margin-top:8px;">
          <button class="w3-button w3-block w3-padding menu-link">
            <i class="fa fa-angle-down fa-fw"><i class="fa-shopping-cart"></i></i>
            Pedidos
          </button>
          <div class="w3-dropdown-content w3-bar-block w3-card-4">
            <a href="/backend/pedidos/tipopedidos/novo/1" class="w3-bar-item w3-button">
              <i class="fa fa-plus fa-fw" aria-hidden="true"></i>
              <span>Novos Pedidos</span>
            </a>
            <a href="/backend/pedidos/tipopedidos/preparo/1" class="w3-bar-item w3-button">
              <i class="fa fa-hourglass-half fa-fw" aria-hidden="true"></i>
              <span>Em Andamento</span>
            </a>
            <a href="/backend/pedidos/tipopedidos/entrega/1" class="w3-bar-item w3-button">
              <i class="fa fa-motorcycle" aria-hidden="true"></i>
              <span>Em entrega</span>
            </a>
            <a href="/backend/pedidos/tipopedidos/concluidos/1" class="w3-bar-item w3-button">
              <i class="fa fa-check fa-fw" aria-hidden="true"></i>
              <span>Finalizados</span>
            </a>

            <a href="/backend/pedidos/tipopedidos/cancelados/1" class="w3-bar-item w3-button">
              <i class="fa fa-times fa-fw" aria-hidden="true"></i>
              <span>Cancelados</span>
            </a>
            <a href="/backend/pedidos" class="w3-bar-item w3-button">
              <i class="fa fa-list fa-fw" aria-hidden="true"></i>
              <span>Todos Pedidos</span>
            </a>
          </div>
        </div>
      </div>
    </nav></a>



    <!-- Overlay para mobile -->
    <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" title="Fechar menudrop lateral" id="myOverlay"></div>

    <!-- Conteúdo -->
    <div class="w3-main" style="margin-top:43px;">
      <div class="w3-container" style="margin-top:16px">
        <!-- O restante do conteúdo da página continua aqui... -->



      <?php
        endif;
        $mensagem = Flash::get();
        if (isset($mensagem)) {
          foreach ($mensagem as $key => $value) {
            if ($key == "type") {
              $tipo = $value == "success" ? "alert-success" : "alert-danger";
              echo "<div class='alert $tipo' role='alert'>";
            } else {
              echo $value;
              echo "</div>";
            }
          }
        }
      ?>

      <script>
        function w3_open() {
          var sb = document.getElementById('mySidebar');
          var ov = document.getElementById('myOverlay');
          if (sb) sb.style.display = 'block';
          if (ov) ov.style.display = 'block';
        }

        function w3_close() {
          var sb = document.getElementById('mySidebar');
          var ov = document.getElementById('myOverlay');
          if (sb) sb.style.display = 'none';
          if (ov) ov.style.display = 'none';
        }
      </script>