<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel Administrativo</title>
    <link rel="stylesheet" href="/backend/assets/css/style.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<!-- Estilos finos para visual e acessibilidade (mesmos do exemplo) -->
<style>
    /* Cartões de métricas */
    .stat-card { border-radius: 10px; box-shadow: 0 6px 16px rgba(0,0,0,.12); position: relative; overflow: hidden; }
    .stat-card .w3-left { opacity: .9 }
    .stat-card h3 { margin: 0; font-weight: 700; letter-spacing: .5px }
    .stat-subtitle { margin: 6px 0 0; font-weight: 600 }

    .bg-blue    { background: linear-gradient(135deg, #1976D2 0%, #42A5F5 100%) }
    .bg-green   { background: linear-gradient(135deg, #2E7D32 0%, #66BB6A 100%) }
    .bg-orange  { background: linear-gradient(135deg, #EF6C00 0%, #FFA726 100%) }
    .bg-indigo  { background: linear-gradient(135deg, #3949AB 0%, #5C6BC0 100%) }

    /* Tabela */
    .card-table { border-radius: 10px; overflow: hidden; box-shadow: 0 6px 16px rgba(0,0,0,.08); }
    .table-head { background: #f7f9fc; border-bottom: 1px solid #e6ebf1 }
    .table-head th { font-weight: 700; color: #2f3a57; white-space: nowrap }
    .table-row:hover { background: #f9fbff }
    .td-tight { white-space: nowrap }
    .badge { font-size: 12px; padding: 4px 10px; border-radius: 999px; font-weight: 700; display: inline-flex; align-items: center; gap: 6px }
    .badge i { font-size: 12px }
    .badge-blue { background: #E3F2FD; color: #1565C0 }
    .badge-amber { background: #FFF8E1; color: #EF6C00 }
    .badge-red { background: #FFEBEE; color: #C62828 }
    .badge-gray { background: #ECEFF1; color: #455A64 }

    /* Ações */
    .action-btn { border-radius: 8px; padding: 6px 10px; font-weight: 600 }
    .action-btn i { margin-right: 6px }
    .btn-edit { background: #E3F2FD; color: #1565C0 }
    .btn-delete { background: #FFEBEE; color: #C62828 }
    .btn-edit:hover { background: #BBDEFB }
    .btn-delete:hover { background: #FFCDD2 }

    /* Paginação */
    .pager .w3-button { border-radius: 8px; font-weight: 600 }
    .pager .w3-button.w3-disabled { opacity: .5; cursor: not-allowed }
</style>

<?php
    // Métricas de produtos
    $total_Produtos        = $total_Produtos ?? 0;
    $total_ativos          = $total_ativos ?? 0;
    $total_inativos        = $total_inativos ?? 0;
    $taxa_ativos = $total_Produtos > 0 ? round(($total_ativos / $total_Produtos) * 100) : 0;

    // Meta de status do produto
    $produtoStatusMeta = function (array $p): array {
        $ativo = isset($p['excluido_em']) && $p['excluido_em'] ? false : true;
        if ($ativo) return ['icon'=>'fa-check-circle','text'=>'Ativo','badge'=>'badge-blue'];
        return ['icon'=>'fa-times-circle','text'=>'Inativo','badge'=>'badge-red'];
    };
?>

<!-- Header -->
<header class="w3-container" style="padding:22px 0 12px 0;">
    <h5 style="margin:0; display:flex; align-items:center; gap:10px; color:#2f3a57">
        <i class="fa fa-box" aria-hidden="true"></i>
        Painel de Produtos
    </h5>
    <div style="color:#6b7a99; font-size:13px; margin-top:6px">Visão geral e gerenciamento dos produtos cadastrados</div>
</header>

<!-- Cards de métricas -->
<div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
        <div class="w3-container w3-padding-16 stat-card bg-blue" title="Total de produtos cadastrados">
            <div class="w3-left"><i class="fa fa-box w3-xxxlarge" style="color:#fff;"></i></div>
            <div class="w3-right"><h3 style="color:#fff;"><?php echo number_format($total_Produtos,0,',','.'); ?></h3></div>
            <div class="w3-clear"></div>
            <h4 class="stat-subtitle" style="color:#E3F2FD">Total de Produtos</h4>
        </div>
    </div>

    <div class="w3-quarter">
        <div class="w3-container w3-padding-16 stat-card bg-green" title="Produtos ativos">
            <div class="w3-left"><i class="fa fa-check-circle w3-xxxlarge" style="color:#fff;"></i></div>
            <div class="w3-right"><h3 style="color:#fff;"><?php echo number_format($total_ativos,0,',','.'); ?></h3></div>
            <div class="w3-clear"></div>
            <h4 class="stat-subtitle" style="color:#E8F5E9">Ativos</h4>
        </div>
    </div>

    <div class="w3-quarter">
        <div class="w3-container w3-padding-16 stat-card bg-orange" title="Produtos inativos">
            <div class="w3-left"><i class="fa fa-times-circle w3-xxxlarge" style="color:#fff;"></i></div>
            <div class="w3-right"><h3 style="color:#fff;"><?php echo number_format($total_inativos,0,',','.'); ?></h3></div>
            <div class="w3-clear"></div>
            <h4 class="stat-subtitle" style="color:#FFF3E0">Inativos</h4>
        </div>
    </div>

    <div class="w3-quarter">
        <div class="w3-container w3-padding-16 stat-card bg-indigo" title="Percentual de produtos ativos">
            <div class="w3-left"><i class="fa fa-percent w3-xxxlarge" style="color:#fff;"></i></div>
            <div class="w3-right"><h3 style="color:#fff;"><?php echo $taxa_ativos; ?>%</h3></div>
            <div class="w3-clear"></div>
            <h4 class="stat-subtitle" style="color:#E8EAF6">Taxa de Ativos</h4>
        </div>
    </div>
</div>

<!-- Botão criar produto -->
<div style="display:flex; justify-content:flex-end; margin-bottom:10px;">
    <a href="/backend/produtos/criar" class="w3-button bg-green w3-text-white" style="padding:8px 12px; border-radius:8px;">
        <i class="fa fa-plus"></i> Criar Produto
    </a>
</div>

<!-- Lista de produtos -->
<?php if (isset($Produtos) && is_array($Produtos) && count($Produtos)>0): ?>
    <div class="w3-responsive card-table">
        <table class="w3-table w3-striped w3-white">
            <thead class="table-head">
                <tr>
                    <th class="td-tight"><i class="fa fa-hashtag"></i> ID</th>
                    <th><i class="fa fa-tag"></i> Nome</th>
                    <th class="td-tight"><i class="fa fa-dollar-sign"></i> Preço</th>
                    <th class="td-tight"><i class="fa fa-boxes"></i> Estoque</th>
                    <th class="td-tight"><i class="fa fa-list"></i> Categoria</th>
                    <th class="td-tight"><i class="fa fa-info-circle"></i> Status</th>
                    <th class="td-tight"><i class="fa fa-pencil"></i> Editar</th>
                    <th class="td-tight"><i class="fa fa-trash"></i> Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($Produtos as $produto): 
                    $statusMeta = $produtoStatusMeta($produto);
                ?>
                    <tr class="table-row">
                        <td class="td-tight"><?php echo $produto['produto_id']; ?></td>
                        <td><?php echo htmlspecialchars($produto['nome']); ?></td>
                        <td class="td-tight">R$ <?php echo number_format($produto['preco'],2,',','.'); ?></td>
                        <td class="td-tight"><?php echo $produto['estoque']; ?></td>
                        <td class="td-tight"><?php echo $produto['categoria_id']; ?></td>
                        <td class="td-tight">
                            <span class="badge <?php echo $statusMeta['badge']; ?>">
                                <i class="fa <?php echo $statusMeta['icon']; ?>"></i> <?php echo $statusMeta['text']; ?>
                            </span>
                        </td>
                        <td class="td-tight">
                            <a class="w3-button action-btn btn-edit" href="produtos/edit/<?php echo $produto['produto_id']; ?>">
                                <i class="fa fa-pencil"></i> Editar
                            </a>
                        </td>
                         <td class="td-tight">
                           <button class="w3-button action-btn btn-delete" data-id="<?php echo $id; ?>" id="botaoExcluir" onclick="SoftDelete(<?php echo htmlspecialchars($produto['produto_id']); ?>)">EXCLUIR</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Paginação -->
    <?php if (isset($paginacao) && is_array($paginacao)): ?>
        <div class="paginacao-controls" style="display:flex; justify-content:space-between; align-items:center; margin-top:16px;">
            <div class="page-selector pager">
                <?php if ((int)$paginacao['pagina_atual'] > 1): ?>
                    <a class="w3-button w3-light-gray" href="/backend/produtos/listar/<?php echo (int)$paginacao['pagina_atual'] - 1; ?>">
                        <i class="fa fa-chevron-left"></i> Anterior
                    </a>
                <?php else: ?>
                    <span class="w3-button w3-light-gray w3-disabled"><i class="fa fa-chevron-left"></i> Anterior</span>
                <?php endif; ?>

                <span style="margin:0 10px; color:#2f3a57; font-weight:600;">
                    Página <?php echo (int)$paginacao['pagina_atual']; ?> de <?php echo (int)$paginacao['ultima_pagina']; ?>
                </span>

                <?php if ((int)$paginacao['pagina_atual'] < (int)$paginacao['ultima_pagina']): ?>
                    <a class="w3-button w3-light-gray" href="/backend/produtos/listar/<?php echo (int)$paginacao['pagina_atual'] + 1; ?>">
                        Próximo <i class="fa fa-chevron-right"></i>
                    </a>
                <?php else: ?>
                    <span class="w3-button w3-light-gray w3-disabled">Próximo <i class="fa fa-chevron-right"></i></span>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
<?php else: ?>
    <div class="w3-panel w3-pale-blue w3-leftbar w3-border-blue" style="border-radius:8px;">
        <p style="margin:8px 0;"><i class="fa fa-info-circle"></i> Nenhum produto encontrado.</p>
    </div>
<?php endif; ?>



<script>
     function SoftDelete(id) {
      const data = JSON.stringify({
         id: id
      });

      const xhr = new XMLHttpRequest();
      xhr.withCredentials = true;

      xhr.addEventListener('readystatechange', function() {
      });

      xhr.open('POST', '/backend/produtos/deletar');
      xhr.setRequestHeader('Content-Type', 'application/json');
      console.log(data)

      Swal.fire({
         title: "Você tem certeza?",
         text: "Você não poderá reverter isso!",
         icon: "warning",
         showCancelButton: true,
         confirmButtonColor: "#3085d6",
         cancelButtonColor: "#d33",
         confirmButtonText: "Sim, Deletar Pedido!"
      }).then((result) => {
         if (result.isConfirmed) {
            if (this.readyState === this.DONE) {
             xhr.send(data);
            Swal.fire({
               title: "Deletado!",
               text: "Seu produto está sendo deletado.",
               icon: "success"
            });
              location.reload()
         }
         }
      });
   }

</script>