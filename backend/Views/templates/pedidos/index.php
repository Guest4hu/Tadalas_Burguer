<style>
    /* ============================================
       PAGE HEADER
    =============================================== */
    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 2.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid var(--border-color);
        flex-wrap: wrap;
        gap: 1rem;
    }
    .page-title {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
    }
    .page-title i { color: var(--accent-red); }
    .page-subtitle {
        color: var(--text-secondary);
        font-size: 0.875rem;
        font-weight: 400;
    }

    /* ============================================
       SELECT STATUS
    =============================================== */
    .select_status {
        appearance: none;
        background: var(--bg-card);
        color: var(--text-primary);
        font-weight: 600;
        font-size: 0.875rem;
        padding: 0.5rem 2.5rem 0.5rem 1rem;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        box-shadow: var(--shadow-sm);
        outline: none;
        cursor: pointer;
        margin: 0 2px;
        transition: all 0.3s ease;
        background-image: url("data:image/svg+xml;charset=UTF-8,<svg width='16' height='16' viewBox='0 0 16 16' fill='none' xmlns='http://www.w3.org/2000/svg'><path d='M4 6l4 4 4-4' stroke='%23FFD700' stroke-width='2' fill='none' stroke-linecap='round'/></svg>");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 16px;
    }
    .select_status:hover,
    .select_status:focus {
        border-color: var(--accent-red);
        box-shadow: 0 0 0 2px rgba(229, 57, 53, 0.2);
    }
    .select_status option {
        color: #1a1a1a;
        background: #fff;
        font-weight: 600;
    }

    /* ============================================
       TABS SUPERIORES (RECEBIDOS / EM PREPARO / ETC)
    =============================================== */
    .nav_botoes ul {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 0;
        width: 100%;
        border-radius: 12px 12px 0 0;
        overflow: hidden;
        border: 1px solid var(--border-color);
        border-bottom: none;
    }
    .nav_botoes ul li {
        flex: 1;
    }
    .tablink {
        width: 100%;
        padding: 1rem 0;
        border: none;
        cursor: pointer;
        font-size: 0.9375rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        background: var(--bg-card);
        color: var(--text-secondary);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        border-right: 1px solid var(--border-color);
    }
    .nav_botoes ul li:last-child .tablink {
        border-right: none;
    }
    .tablink:hover {
        background: var(--bg-card-hover);
        color: var(--text-primary);
    }
    .tablink.active,
    .tablink[style*="background"] {
        background: var(--accent-red) !important;
        color: #fff !important;
        box-shadow: 0 4px 16px rgba(229, 57, 53, 0.3);
    }
    .tablink i {
        font-size: 1rem;
    }

    @media (max-width: 900px) {
        .nav_botoes ul {
            flex-direction: column;
            border-radius: 12px;
        }
        .tablink {
            font-size: 0.875rem;
            padding: 0.75rem 0;
            border-right: none;
            border-bottom: 1px solid var(--border-color);
        }
        .nav_botoes ul li:last-child .tablink {
            border-bottom: none;
        }
    }

    /* ============================================
       CONTEÚDO DAS ABAS
    =============================================== */
    .tabcontent {
        padding: 2rem 1.5rem;
        background: var(--gradient-card);
        border-radius: 0 0 12px 12px;
        border: 1px solid var(--border-color);
        border-top: 2px solid var(--accent-red);
        box-shadow: var(--shadow-md);
        animation: fadeInTab 0.3s;
        min-height: 320px;
    }
    @keyframes fadeInTab {
        from { opacity: 0; transform: translateY(10px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* Empty state text */
    .titulo_carregando {
        text-align: center;
        padding: 3rem;
        color: var(--text-secondary);
        font-size: 1rem;
        font-weight: 500;
    }

    /* ============================================
       SISTEMA DE ABAS INTERNAS (VER / EDITAR / ENDEREÇO)
    =============================================== */
    .tabs-menu {
        display: flex;
        gap: 0.625rem;
        margin-bottom: 1rem;
    }
    .tab-btn {
        padding: 0.625rem 1rem;
        background: var(--bg-card);
        color: var(--text-secondary);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .tab-btn:hover {
        background: var(--bg-card-hover);
        color: var(--text-primary);
        border-color: var(--accent-red);
    }
    .tab-btn.active {
        background: var(--accent-red);
        color: #fff;
        border-color: var(--accent-red);
    }
    .tab-content {
        display: none;
        background: var(--bg-secondary);
        padding: 1.25rem;
        border-radius: 10px;
        border: 1px solid var(--border-color);
    }
    .tab-content.active {
        display: block;
    }

    /* ============================================
       TABELAS (dinâmicas via JS)
    =============================================== */
    .card-table {
        background: var(--gradient-card);
        border-radius: 12px;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-color);
        overflow: hidden;
    }
    .table-default,
    .card-table table {
        width: 100%;
        border-collapse: collapse;
    }
    .table-head,
    .card-table thead {
        background: rgba(229, 57, 53, 0.08);
        border-bottom: 2px solid var(--accent-red);
    }
    .table-head th,
    .card-table thead th,
    .table-default th {
        padding: 1.25rem 1rem;
        text-align: left;
        font-weight: 700;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text-primary);
        white-space: nowrap;
    }
    .table-head th i,
    .card-table thead th i {
        margin-right: 0.5rem;
        color: var(--accent-gold);
    }
    .table-row,
    .card-table tbody tr {
        border-bottom: 1px solid var(--border-color);
        transition: all 0.3s ease;
    }
    .table-row:hover,
    .card-table tbody tr:hover {
        background: rgba(229, 57, 53, 0.05);
    }
    .td-tight,
    .card-table tbody td {
        padding: 1.25rem 1rem;
        color: var(--text-secondary);
        font-size: 0.9375rem;
        white-space: nowrap;
    }
    .card-table tbody td:first-child {
        font-weight: 700;
        color: var(--text-primary);
    }
    .table-default td {
        padding: 0.75rem;
        border: 1px solid var(--border-color);
        color: var(--text-secondary);
    }
    .table-default th {
        background: rgba(229, 57, 53, 0.08);
        color: var(--text-primary);
        border: 1px solid var(--border-color);
    }

    /* ============================================
       BADGES
    =============================================== */
    .badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.8125rem;
        font-weight: 600;
        white-space: nowrap;
        background: rgba(255, 193, 7, 0.15);
        color: var(--accent-gold);
        border: 1px solid rgba(255, 193, 7, 0.3);
    }

    /* ============================================
       BOTÕES DE AÇÃO
    =============================================== */
    .action-btn {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-size: 0.8125rem;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }
    .btn-view {
        background: rgba(76, 175, 80, 0.15);
        color: #4CAF50;
        border: 1px solid rgba(76, 175, 80, 0.3);
    }
    .btn-view:hover {
        background: rgba(76, 175, 80, 0.25);
        transform: translateY(-1px);
    }
    .btn-edit,
    .btn-blue {
        background: rgba(33, 150, 243, 0.15);
        color: #2196F3;
        border: 1px solid rgba(33, 150, 243, 0.3);
    }
    .btn-edit:hover,
    .btn-blue:hover {
        background: rgba(33, 150, 243, 0.25);
        transform: translateY(-1px);
    }
    .btn-delete {
        background: rgba(229, 57, 53, 0.15);
        color: var(--accent-red);
        border: 1px solid rgba(229, 57, 53, 0.3);
    }
    .btn-delete:hover {
        background: rgba(229, 57, 53, 0.25);
        transform: translateY(-1px);
    }
    .btn-primary {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        border: none;
        font-weight: 600;
        cursor: pointer;
        background: #4CAF50;
        color: #fff;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        background: #388E3C;
        transform: translateY(-1px);
    }

    /* ============================================
       MODAL
    =============================================== */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        backdrop-filter: blur(4px);
        padding-top: 40px;
    }
    .modal-content {
        background: var(--bg-secondary);
        margin: auto;
        width: 90%;
        max-width: 1200px;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 16px 48px rgba(0, 0, 0, 0.5);
        border: 1px solid var(--border-color);
        position: relative;
        max-height: 85vh;
        overflow-y: auto;
    }
    .modal-content::-webkit-scrollbar {
        width: 6px;
    }
    .modal-content::-webkit-scrollbar-track {
        background: var(--bg-card);
        border-radius: 3px;
    }
    .modal-content::-webkit-scrollbar-thumb {
        background: var(--accent-red);
        border-radius: 3px;
    }
    .close {
        position: absolute;
        right: 1.25rem;
        top: 0.75rem;
        font-size: 1.75rem;
        cursor: pointer;
        color: var(--text-secondary);
        transition: all 0.2s ease;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
    }
    .close:hover {
        color: var(--accent-red);
        background: rgba(229, 57, 53, 0.1);
        border-color: var(--accent-red);
    }

    /* ============================================
       MODAL – DETALHES DO PEDIDO (conteúdo dinâmico)
    =============================================== */

    /* Títulos dentro do modal */
    .modal-content h3,
    .modal-content h4,
    #itemsPedidos h3,
    #itemsPedidos h4,
    #editarItems h3,
    #editarItems h4 {
        color: var(--text-primary) !important;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .modal-content h3 i,
    .modal-content h4 i,
    #itemsPedidos h3 i,
    #itemsPedidos h4 i {
        color: var(--accent-gold) !important;
    }

    /* Inputs numéricos (quantidade) */
    .modal-content .input-number,
    .input-number {
        background: var(--bg-card);
        color: var(--text-primary);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 0.5rem 0.75rem;
        font-size: 0.9375rem;
        font-weight: 600;
        width: 80px;
        outline: none;
        transition: all 0.3s ease;
        -moz-appearance: textfield;
    }
    .input-number::-webkit-outer-spin-button,
    .input-number::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    .input-number:focus {
        border-color: var(--accent-red);
        box-shadow: 0 0 0 2px rgba(229, 57, 53, 0.2);
    }

    /* Lista de detalhes (Pagamento / Endereço) */
    .details-list {
        list-style: none;
        padding: 0;
        margin: 0.75rem 0;
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }
    .details-list li {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 10px;
        color: var(--text-secondary);
        font-size: 0.9375rem;
        flex-wrap: wrap;
    }
    .details-list li strong {
        color: var(--text-primary);
        font-weight: 700;
        min-width: fit-content;
    }

    /* Selects dentro do modal (status / método pagamento) */
    .modal-content .select_status,
    .details-list .select_status {
        background: var(--bg-secondary);
        color: var(--text-primary);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 0.5rem 2.5rem 0.5rem 1rem;
        font-weight: 600;
        font-size: 0.875rem;
        flex: 1;
        min-width: 160px;
    }

    /* Select de adicionar produto */
    .modal-content .select_produto {
        background: var(--bg-secondary);
        color: var(--text-primary);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 0.5rem 2.5rem 0.5rem 1rem;
        font-weight: 600;
        font-size: 0.875rem;
    }

    /* Seção de detalhes (grid Endereço + Pagamento) */
    .pedido-detalhes {
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--border-color);
    }
    .pedido-detalhes h4 {
        margin-bottom: 0.5rem;
    }

    /* Botão "Salvar Alterações" dentro do modal */
    .modal-content .btn-primary,
    .btn-atualizarFormulario {
        margin-top: 1.5rem;
        padding: 0.75rem 2rem;
        border-radius: 10px;
        font-size: 1rem;
        font-weight: 700;
        background: var(--accent-red);
        color: #fff;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: 0 4px 16px rgba(229, 57, 53, 0.3);
        transition: all 0.3s ease;
    }
    .modal-content .btn-primary:hover,
    .btn-atualizarFormulario:hover {
        background: var(--accent-red-hover);
        box-shadow: 0 6px 24px rgba(229, 57, 53, 0.5);
        transform: translateY(-2px);
    }

    /* Linha "Adicionar Produto" na tabela */
    .modal-content .table-default tr:last-child td {
        background: rgba(229, 57, 53, 0.04);
        border-top: 2px solid var(--border-color);
    }

    /* Botão Excluir dentro da tabela do modal */
    .modal-content .deleteItensPedido {
        font-size: 0.8125rem;
    }

    /* ============================================
       ANIMAÇÃO
    =============================================== */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 768px) {
        .page-header { flex-direction: column; align-items: flex-start; }
        .tabcontent { padding: 1rem; }
        .modal-content { width: 95%; padding: 1rem; }
    }
</style>

<!-- Page Header -->
<header class="page-header">
    <div>
        <h1 class="page-title">
            <i class="fa-solid fa-utensils"></i>
            Painel de Pedidos
        </h1>
        <p class="page-subtitle">Visão geral e gerenciamento dos pedidos do sistema</p>
    </div>
</header>

<nav class="nav_botoes">
   <ul>
      <li>
         <button class="tablink pedidosBusca" data-id="1" onclick="openPage('novo', this, 'red');" id="defaultOpen">
            <i class="fa fa-plus-square" aria-hidden="true"></i> Recebidos
         </button>
      </li>
      <li>
         <button class="tablink pedidosBusca" data-id="2" onclick="openPage('emPreparo', this, 'green');">
            <i class="fa fa-fire" aria-hidden="true"></i> Em Preparo
         </button>
      </li>
      <li>
         <button class="tablink pedidosBusca" data-id="3" onclick="openPage('emEntrega', this, 'blue');">
            <i class="fa fa-truck" aria-hidden="true"></i> Saiu Para Entrega
         </button>
      </li>
      <li>
         <button class="tablink pedidosBusca" data-id="4" onclick="openPage('concluido', this, 'orange')">
            <i class="fa fa-check-circle" aria-hidden="true"></i> Concluídos
         </button>
      </li>
      <li>
         <button class="tablink pedidosBusca" data-id="5" onclick="openPage('cancelado', this, 'orange')">
            <i class="fa fa-ban" aria-hidden="true"></i> Cancelados
         </button>
      </li>
   </ul>
</nav>

<div id="novo" class="tabcontent">
   <div class="container" id="itens1">
   </div>
</div>
<div id="emPreparo" class="tabcontent">
   <div class="container" id="itens2">
   </div>
</div>
<div id="emEntrega" class="tabcontent">
   <div class="container" id="itens3">
   </div>
</div>
<div id="concluido" class="tabcontent">
   <div class="container" id="itens4">
   </div>
</div>
<div id="cancelado" class="tabcontent">
   <div class="container" id="itens5">
   </div>
</div>

<div id="id01" class="modal">
   <div class="modal-content">
      <button class="close" title="Fechar Modal">&times;</button>
      <div id="itemsPedidos">
      </div>
   </div>
</div>
<div id="id02" class="modal">
   <div class="modal-content">
      <button class="close" title="Fechar Modal">&times;</button>
      <div id="editarItems"></div>
   </div>
</div>


<script src="Views/public/js/pedidos/pedidos.js" type="module" defer></script>


<script>
function openPage(pageName, elmnt, color) {
   var i, tabcontent, tablinks;
   tabcontent = document.getElementsByClassName("tabcontent");
   for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
   }
   tablinks = document.getElementsByClassName("tablink");
   for (i = 0; i < tablinks.length; i++) {
      tablinks[i].style.backgroundColor = "";
   }
   document.getElementById(pageName).style.display = "block";
   elmnt.style.backgroundColor = color;
}
document.querySelectorAll('.modal .close').forEach(btn => {
   btn.onclick = function() {
      btn.closest('.modal').style.display = "none";
   };
});

</script>