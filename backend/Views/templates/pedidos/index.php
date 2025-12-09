<style>

/* ============================================
   SELECT STATUS
=============================================== */
.select_status {
   appearance: none;
   background: linear-gradient(135deg, #3949AB, #5C6BC0);
   font-weight: 600;
   font-size: 15px;
   padding: 8px 32px 8px 12px;
   border: none;
   border-radius: 8px;
   box-shadow: 0 2px 8px rgba(60, 60, 120, 0.10);
   outline: none;
   cursor: pointer;
   margin: 0 2px;
   background-image: url("data:image/svg+xml;charset=UTF-8,<svg width='16' height='16' viewBox='0 0 16 16' fill='orange' xmlns='http://www.w3.org/2000/svg'><path d='M4 6l4 4 4-4' stroke='white' stroke-width='2' fill='none' stroke-linecap='round'/></svg>");
   background-repeat: no-repeat;
   background-position: right 12px center;
   background-size: 18px;
}

.select_status:hover,
.select_status:focus {
   background: linear-gradient(135deg, #1976D2, #42A5F5);
   color: #fff;
   box-shadow: 0 4px 16px rgba(33, 150, 243, 0.15);
}

.select_status option {
   color: #2f3a57;
   background: #fff;
   font-weight: 600;
}

@media (max-width: 900px) {
   .select_status {
      font-size: 13px;
      padding: 6px 28px 6px 10px;
   }
}

/* ============================================
   TABS SUPERIORES (NOVO / EM PREPARO / ETC)
=============================================== */
.nav_botoes ul {
   display: flex;
   list-style: none;
   padding: 0;
   margin: 0;
   width: 100%;
   border-radius: 12px 12px 0 0;
   box-shadow: 0 2px 8px rgba(60, 60, 120, .04);
   overflow: hidden;
   border-bottom: 1px solid #e6e6e6;
}

.nav_botoes ul li {
   flex: 1;
}

.tablink {
   width: 100%;
   padding: 16px 0;
   border: none;
   cursor: pointer;
   font-size: 17px;
   font-weight: 700;
   letter-spacing: 0.6px;
   background: linear-gradient(135deg, #3949AB, #5C6BC0);
   color: #fff;
   transition: 0.2s ease;
}

.tablink:hover {
   background: linear-gradient(135deg, #1976D2, #42A5F5);
}

.tablink.active {
   background: linear-gradient(135deg, #EF6C00, #FFA726);
   box-shadow: 0 6px 24px rgba(255, 152, 0, 0.18);
}

@media (max-width: 900px) {
   .nav_botoes ul {
      flex-direction: column;
   }
   .tablink {
      font-size: 15px;
      padding: 12px 0;
   }
}

/* ============================================
   CONTEÚDO DAS ABAS
=============================================== */
.tabcontent {
   padding: 32px 24px;
   background: #f7f9fc;
   border-radius: 0 0 12px 12px;
   box-shadow: 0 6px 24px rgba(0, 0, 0, .08);
   animation: fadeInTab .3s;
   min-height: 320px;
}

@keyframes fadeInTab {
   from { opacity: 0; transform: translateY(10px); }
   to { opacity: 1; transform: translateY(0); }
}

/* ============================================
   SISTEMA DE ABAS INTERNAS (VER / EDITAR / ENDEREÇO)
=============================================== */

.tabs-menu {
   display: flex;
   gap: 10px;
   margin-bottom: 15px;
}

.tab-btn {
   padding: 10px 16px;
   background: #e4e8f0;
   color: #2f3a57;
   border: none;
   border-radius: 6px;
   font-weight: 600;
   cursor: pointer;
   transition: 0.2s ease;
}

.tab-btn:hover {
   background: #d7dbe3;
}

.tab-btn.active {
   background: #2f3a57;
   color: #fff;
}

.tab-content {
   display: none;
   background: #fff;
   padding: 18px;
   border-radius: 8px;
   border: 1px solid #dcdcdc;
}

.tab-content.active {
   display: block;
}

/* ============================================
   TABELAS
=============================================== */
.table-default {
   width: 100%;
   border-collapse: collapse;
   margin-top: 15px;
}

.table-default th,
.table-default td {
   padding: 10px;
   border: 1px solid #ccc;
}

.table-default th {
   background: #f4f7fb;
   font-weight: 700;
   color: #2f3a57;
}

/* ============================================
   BOTÕES
=============================================== */
.btn-primary,
.btn-blue,
.btn-delete,
.btn-view {
   padding: 8px 14px;
   border-radius: 8px;
   border: none;
   font-weight: 600;
   cursor: pointer;
}

.btn-primary {
   background: #2f8f48;
   color: #fff;
}

.btn-primary:hover {
   background: #256c36;
}

.btn-blue {
   background: #2f5fda;
   color: white;
}

.btn-blue:hover {
   background: #234ac2;
}

.btn-delete {
   background: #FFEBEE;
   color: #C62828;
}

.btn-delete:hover {
   background: #FFCDD2;
}

.btn-view {
   background: #E8F5E9;
   color: #2E7D32;
}

.btn-view:hover {
   background: #C8E6C9;
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
   background: rgba(0,0,0,.45);
   padding-top: 40px;
}

.modal-content {
   background: #fff;
   margin: auto;
   width: 90%;
   max-width: 1200px;
   border-radius: 12px;
   padding: 24px;
   box-shadow: 0 8px 30px rgba(0,0,0,.2);
   position: relative;
}

.close {
   position: absolute;
   right: 18px;
   top: 10px;
   font-size: 26px;
   cursor: pointer;
   transition: .2s;
}

.close:hover {
   color: #C62828;
}

</style>

<header class="w3-container" style="padding:22px 0 12px 0;">
   <h5 style="margin:0; display:flex; align-items:center; gap:10px; color:#2f3a57">
      <i class="fa fa-cutlery" aria-hidden="true"></i>
      Painel de Pedidos
   </h5>
   <div style="color:#6b7a99; font-size:13px; margin-top:6px">Visão geral e gerenciamento dos pedidos do sistema</div>
</header>

<button>Adicionar Pedido</button>

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


<script src="Views/public/js/pedidos/pedidos.js" defer type="module"></script>


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
document.getElementById("defaultOpen").click();

</script>