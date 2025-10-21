<?php
use App\Tadala\Core\Flash;

// Contexto atual
$uriPath   = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$userName  = isset($_SESSION['nome']) && is_string($_SESSION['nome']) ? $_SESSION['nome'] : 'Usuário';

// Menu configurável com ícones (Font Awesome 4.7)
if(isset($tipo)) {
  if($tipo !== 1) {
  $menu = [
  [ 'href' => '/backend/usuario',           'label' => 'Usuários',               'icon' => 'fa-users' ],
  [ 'href' => '/backend/cargo',             'label' => 'Cargos',                 'icon' => 'fa-briefcase' ],
  [ 'href' => '/backend/statusFuncionario', 'label' => 'Status dos Funcionários','icon' => 'fa-address-card' ],
  [ 'href' => '/backend/statusPagamento',   'label' => 'Status de Pagamentos',   'icon' => 'fa-money' ],
  [ 'href' => '/backend/statusPedido',      'label' => 'Status dos Pedidos',     'icon' => 'fa-check-square-o' ],
  [ 'href' => '/backend/tipoUsuario',       'label' => 'Tipos de Usuários',      'icon' => 'fa-user-plus' ],
  [ 'href' => '/backend/agendamento',      'label' => 'Agendamentos',           'icon' => 'fa-calendar' ],
  [ 'href' => '/backend/categoria',         'label' => 'Categorias',             'icon' => 'fa-tags' ],
  [ 'href' => '/backend/endereco',          'label' => 'Endereços',              'icon' => 'fa-map-marker' ],
  [ 'href' => '/backend/funcionarios',      'label' => 'Funcionários',           'icon' => 'fa-address-book' ],
  [ 'href' => '/backend/itensPedidos',      'label' => 'Itens do Pedido',        'icon' => 'fa-list-ul' ],
  [ 'href' => '/backend/pagamento',         'label' => 'Pagamentos',             'icon' => 'fa-credit-card' ],
  [ 'href' => '/backend/pedidos',           'label' => 'Pedidos',                'icon' => 'fa-shopping-cart' ],
  [ 'href' => '/backend/produtos',          'label' => 'Produtos',               'icon' => 'fa-cubes' ],
  [ 'href' => '/backend/promocoes',         'label' => 'Promoções',              'icon' => 'fa-bullhorn' ]  
  ];
} else {
  $menu = [
    [ 'href' => '/backend/agendamentos',      'label' => 'Agendamentos',           'icon' => 'fa-calendar' ],
    [ 'href' => '/backend/pedidos',           'label' => 'Pedidos',                'icon' => 'fa-shopping-cart' ],
    [ 'href' => '/backend/itensPedidos',      'label' => 'Itens do Pedido',        'icon' => 'fa-list-ul' ],
  ];
}
}


// Helpers
$e = fn($v) => htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');
$isActive = function (string $current, string $href): bool {
  if ($href === '/') return $current === '/';
  return strpos($current, $href) === 0;
};
$w3AlertClass = function (?string $type): string {
  switch (strtolower((string)$type)) {
    case 'success': return 'w3-green';
    case 'error':   return 'w3-red';
    case 'warning': return 'w3-yellow';
    case 'info':
    default:        return 'w3-blue';
  }
};

// Normaliza mensagens do Flash para uma lista [{type, message}]
$flashRaw  = Flash::getAll();
$flashList = [];
if (is_array($flashRaw)) {
  // Caso seja um array associativo único
  if (isset($flashRaw['type']) || isset($flashRaw['message']) || isset($flashRaw['msg'])) {
    $flashList[] = [
      'type'    => $flashRaw['type']    ?? 'info',
      'message' => $flashRaw['message'] ?? ($flashRaw['msg'] ?? ''),
    ];
  } else {
    foreach ($flashRaw as $m) {
      if (is_array($m)) {
        $flashList[] = [
          'type'    => $m['type']    ?? 'info',
          'message' => $m['message'] ?? ($m['msg'] ?? ''),
        ];
      } elseif (!is_null($m)) {
        $flashList[] = ['type' => 'info', 'message' => (string)$m];
      }
    }
  }
} elseif (!empty($flashRaw)) {
  $flashList[] = ['type' => 'info', 'message' => (string)$flashRaw];
}
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
  <style>
  :root { --sidebar-width: 300px; }
  html, body, h1, h2, h3, h4, h5 { font-family: "Raleway", sans-serif; }
  .brand { letter-spacing: .5px; }
  .sidebar-avatar { width: 46px; height: 46px; border-radius: 50%; object-fit: cover; }
  .w3-sidebar { width: var(--sidebar-width) !important; }
  .w3-main { margin-left: var(--sidebar-width); }
  @media (max-width: 992px) {
    .w3-main { margin-left: 0 !important; }
  }
  .menu-link { display: flex; align-items: center; gap: 10px; }
  .menu-link .fa { width: 20px; text-align: center; }
  .menu-item-active { font-weight: 600; }
  .topbar { z-index: 4; }
  .flash-close { cursor: pointer; }
  </style>
</head>
<body class="w3-light-grey">

<?php if(!$fullScreen) { ?>
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
    src="https://ui-avatars.com/api/?name=<?=urlencode($userName)?>&background=111&color=fff&size=92&bold=true">
  </div>
  <div class="w3-col s8 w3-bar">
    <span>Bem-vindo(a), <strong><?= $e($userName) ?></strong></span><br>
    <a href="/backend/mensagens" class="w3-bar-item w3-button" title="Mensagens"><i class="fa fa-envelope"></i></a>
    <a href="/backend/perfil" class="w3-bar-item w3-button" title="Perfil"><i class="fa fa-user"></i></a>
    <a href="/backend/configuracoes" class="w3-bar-item w3-button" title="Configurações"><i class="fa fa-cog"></i></a>
  </div>
  </div>
  <hr>
  <div class="w3-container">
  <h5 class="w3-opacity"><i class="fa fa-dashboard"></i> Dashboard</h5>
  </div>

  <div class="w3-bar-block">
  <a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="Fechar menu">
    <i class="fa fa-remove fa-fw"></i>  Fechar Menu
  </a>

  


  <?php foreach ($menu as $item): 
    $active = $isActive($uriPath, $item['href']);
    $classes = 'w3-bar-item w3-button w3-padding menu-link';
    if ($active) $classes .= ' w3-blue menu-item-active';
  ?>
    <a href="<?= $e($item['href']) ?>" class="<?= $e($classes) ?>">
    <i class="fa <?= $e($item['icon']) ?> fa-fw" aria-hidden="true"></i>
    <span><?= $e($item['label']) ?></span>
    </a>
  <?php endforeach; ?>
  </div>
</nav>

<!-- Overlay para mobile -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" title="Fechar menu lateral" id="myOverlay"></div>

<!-- Conteúdo -->
<div class="w3-main" style="margin-top:43px;">
  <div class="w3-container" style="margin-top:16px">
<?php } ?>
  <?php if (!empty($flashList)): ?>
    <?php foreach ($flashList as $msg):
    $text = trim((string)($msg['message'] ?? ''));
    if ($text === '') continue;
    $color = $w3AlertClass($msg['type'] ?? 'info');
    ?>
    <div class="w3-panel <?= $e($color) ?> w3-display-container w3-round">
      <span class="w3-button w3-display-topright w3-small w3-transparent flash-close" onclick="this.parentElement.style.display='none'" aria-label="Fechar alerta">&times;</span>
      <?= $e($text) ?>
    </div>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>
<!-- O restante do conteúdo da página continua aqui... -->



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