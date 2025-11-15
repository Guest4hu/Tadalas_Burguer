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
   max-width: 600px;
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

<nav class="nav_botoes">
   <ul>
      <li>
         <button class="tablink pedidosBusca" data-id="1" onclick="openPage('novo', this, 'red')" id="defaultOpen">
            <i class="fa fa-plus-square" aria-hidden="true"></i> Novos
         </button>
      </li>
      <li>
         <button class="tablink pedidosBusca" data-id="2" onclick="openPage('emPreparo', this, 'green')">
            <i class="fa fa-fire" aria-hidden="true"></i> Em Preparo
         </button>
      </li>
      <li>
         <button class="tablink pedidosBusca" data-id="3" onclick="openPage('emEntrega', this, 'blue')">
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

<script defer>
   /**
    * Painel de Pedidos - JS
    * Organização minuciosa por GitHub Copilot
   */
  
  // ==========================
  // Variáveis Globais
  // ==========================


  // Parar o polling anterior quanto trocar de aba
  let comparacao = null;
  

  // Comparar com as notificações qtdAnterior
  let qtdAnterior = 0;
// ==========================
// Funções utilitárias
// ==========================


// Fetch para dados do itens ver Pedidos

async function fetchDadosPedido(pedidoId) {
         let response = await fetch(`/backend/pedidos/busca/${pedidoId}`, { method: "GET" });
         const dados = await response.json();
         return dados;
      }

/**
 * Função para renderizar os Dados do ItensPedido
 */
function renderizarItensDoPedido(dados) {
   const items = document.getElementById("itemsPedidos");
   let qtd = 0;
   let valorTotal = 0;
   let metodo = '';
   let statusPagamento = '';
   const pedidoId = dados.dados2[0].pedido_id;

   // Início do HTML principal
   let html = `
   <div class="tabs-container">

      <!-- MENU DAS ABAS -->
      <div class="tabs-menu">
         <button class="tab-btn active" data-aba="aba-ver" onclick="abrirAba('aba-ver')">Ver</button>
         <button class="tab-btn" data-aba="aba-pagamento" onclick="abrirAba('aba-pagamento')">Pagamento</button>
         <button class="tab-btn" data-aba="aba-endereco" onclick="abrirAba('aba-endereco')">Endereço</button>
      </div>

      <!-- ABA 1: VISUALIZAR PEDIDO -->
      <div id="aba-ver" class="tab-content active">
         <h3 style="margin-top:0; color:#2f3a57">
            <i class="fa fa-cutlery"></i> Detalhes do Pedido
         </h3>
   `;

   // Endereço de entrega se for delivery
   if (dados.dados2[0].tipo_pedido === 3) {
      html += `
         <h4 style="color:#2f3a57; margin-top:15px;">
            <i class="fa fa-map-marker"></i> Endereço de Entrega
         </h4>
         <ul class="details-list">
            <li><strong>Rua:</strong> ${dados.dados2[0].rua}, Nº ${dados.dados2[0].numero}</li>
            <li><strong>Bairro:</strong> ${dados.dados2[0].bairro}</li>
            <li><strong>Cidade:</strong> ${dados.dados2[0].cidade} - ${dados.dados2[0].estado}</li>
            <li><strong>CEP:</strong> ${dados.dados2[0].cep}</li>
         </ul>
      `;
   }

   // Tabela de itens do pedido
   html += `
         <table class="table-default">
            <thead>
               <tr>
                  <th>Produto</th>
                  <th>Qtd</th>
                  <th>Valor Unitário</th>
                  <th>Subtotal</th>
                  <th>Remover</th>
               </tr>
            </thead>
            <tbody>
   `;

   dados.dados2.forEach(item => {
      qtd++;
      let subtotal = item.quantidade * item.valor_unitario;
      valorTotal += subtotal;
      metodo = item.descricao_metodo;
      statusPagamento = item.descricao;

      html += `
         <tr>
            <input type="hidden" id="itemID${qtd}" value="${item.item_id}">
            <td>${item.nome}</td>
            <td>
               <input type="number" min="1" class="input-number" id="itemQTD${qtd}" value="${item.quantidade}">
            </td>
            <td>R$ ${Number(item.valor_unitario).toFixed(2)}</td>
            <td>R$ ${subtotal.toFixed(2)}</td>
            <td>
               <button class="btn-delete" onclick="SoftDeleteItens(${item.item_id}, ${item.pedido_id})">
                  Excluir
               </button>
            </td>
         </tr>
      `;
   });

   // Linha para adicionar novo produto
   html += `
         <tr>
            <td colspan="2" style="text-align:right;">
               <select id="novo-Produto${pedidoId}" class="select_status" style="max-width:240px;">
                  <option value="0">ESCOLHA O PRODUTO</option>
                  <?php foreach ($produtos as $produto): ?>
                     <option value="<?php echo $produto['produto_id']; ?>@<?php echo $produto['preco']; ?>">
                        <?php echo $produto['nome']; ?>
                     </option>
                  <?php endforeach; ?>
               </select>
               <input type="number" min="1" id="nova-Quantidade" class="input-number" value="1" style="margin-left:8px;">
               <button class="btn-blue" onclick="adicionarProduto('${pedidoId}')" style="margin-left:8px;">
                  <i class="fa fa-plus"></i> Adicionar
               </button>
            </td>
         </tr>
   `;

   html += `
            </tbody>
         </table>
         <button class="btn-primary" onclick="qtditemFormulario(${qtd}, ${pedidoId})">
            <i class="fa fa-save"></i> Salvar Alterações
         </button>
         <h4 style="margin-top:18px; color:#2f3a57"><i class="fa fa-credit-card"></i> Pagamento</h4>
         <ul class="details-list">
            <li><strong>Valor Total:</strong> R$ ${valorTotal.toFixed(2)}</li>
            <li><strong>Método:</strong> ${metodo}</li>
            <li><strong>Status:</strong> ${statusPagamento}</li>
         </ul>
      </div>
   `;

   // ABA 2: PAGAMENTO
   html += `
      <div id="aba-pagamento" class="tab-content" style="display:none;">
         <h3 style="color:#2f3a57; margin-top:0;">
            <i class="fa fa-money"></i> Editar Pagamento
         </h3>
         <form id="formPagamento${pedidoId}">
            <input type="hidden" name="pedido_id" value="${pedidoId}">
            <input type="hidden" name="valor_total" value="${valorTotal.toFixed(2)}">
            <label for="metodo${pedidoId}" style="font-weight:600;">Método de Pagamento:</label>
            <select id="metodo${pedidoId}" class="select_status" name="metodo" required>
               <?php foreach ($metodos_pagamento as $metodo): ?>
                  <option value="<?php echo $metodo['id']; ?>">
                     <?php echo $metodo['descricao']; ?>
                  </option>
               <?php endforeach; ?>
            </select>
            <label for="status_pagamento_id${pedidoId}" style="font-weight:600; margin-top:10px;">Status:</label>
            <select id="status_pagamento_id${pedidoId}" class="select_status" name="status_pagamento_id" required>
               <?php foreach ($status_pagamento as $status): ?>
                  <option value="<?php echo $status['id']; ?>">
                     <?php echo $status['descricao']; ?>
                  </option>
               <?php endforeach; ?>
            </select>
            <button type="button" class="btn-primary" style="margin-top:12px;" onclick="salvarPagamento(${pedidoId})">
               <i class="fa fa-save"></i> Salvar Pagamento
            </button>
         </form>
      </div>
   `;

   // Seleciona o status atual após renderizar
   setTimeout(() => {
      const selectAtual = document.getElementById(`status_pagamento_id${pedidoId}`);
      if (selectAtual) selectAtual.value = `${dados.dados2[0].status_pagamento_id}`;
   }, 0);

   // ABA 3: ENDEREÇO
   html += `
      <div id="aba-endereco" class="tab-content" style="display:none;">
         <h3 style="color:#2f3a57; margin-top:0;">
            <i class="fa fa-home"></i> Endereço do Pedido
         </h3>
         <form id="formEndereco${pedidoId}">
            <label for="endRua${pedidoId}">Rua:</label>
            <input type="text" class="input-text" id="endRua${pedidoId}" value="${dados.dados2[0].rua || ''}" placeholder="Ex: Avenida Brasil">
            <label for="endNumero${pedidoId}">Número:</label>
            <input type="text" class="input-text" id="endNumero${pedidoId}" value="${dados.dados2[0].numero || ''}">
            <label for="endBairro${pedidoId}">Bairro:</label>
            <input type="text" class="input-text" id="endBairro${pedidoId}" value="${dados.dados2[0].bairro || ''}">
            <label for="endCidade${pedidoId}">Cidade:</label>
            <input type="text" class="input-text" id="endCidade${pedidoId}" value="${dados.dados2[0].cidade || ''}">
            <label for="endEstado${pedidoId}">Estado:</label>
            <input type="text" class="input-text" id="endEstado${pedidoId}" value="${dados.dados2[0].estado || ''}">
            <label for="endCEP${pedidoId}">CEP:</label>
            <input type="text" class="input-text" id="endCEP${pedidoId}" value="${dados.dados2[0].cep || ''}">
            <button type="button" class="btn-primary" style="margin-top:12px;" onclick="salvarEndereco(${pedidoId})">
               <i class="fa fa-save"></i> Salvar Endereço
            </button>
         </form>
      </div>
   `;

   // Fecha o container das abas
   html += `</div>`;

   // Renderiza no modal
   items.innerHTML = html;
   const modal = document.getElementById('id01');
   modal.style.display = "block";
   window.onclick = function(event) {
      if (event.target === modal) {
         modal.style.display = "none";
      }
   };
}

/**
 * Função para obter os dados da Model de Editar items
 */

async function conteudoEditarItensDoPedido(id) {
         let response = await fetch(`/backend/pedidos/busca/${id}`, { method: "GET" });
         const dados = await response.json();
         return dados;
      }
/**
 * Função para renderizar os itens do pedido para edição
 */

function renderizarEditarItensDoPedido(dados, id) {
         let qtd = 0;
         const items = document.getElementById("editarItems");
         console.log(dados);
        let html = `
<div class="tabs-container">

   <div class="tabs-menu">
      <button class="tab-btn active" onclick="abrirAba('aba-itens')">Itens do Pedido</button>
      <button class="tab-btn" onclick="abrirAba('aba-pagamento')">Pagamento</button>
   </div>

   <div id="aba-itens" class="tab-content active">
      <h3 style="margin-top:0; color:#2f3a57"><i class="fa fa-edit"></i> Editar Itens do Pedido</h3>

      <table style="width:100%; border-collapse:collapse; margin-bottom:16px;">
         <thead>
            <tr>
               <th style="border:1px solid #ccc; padding:8px;">Produto</th>
               <th style="border:1px solid #ccc; padding:8px;">Quantidade</th>
            </tr>
         </thead>
         <tbody>
`;
         dados.dados2.forEach((item) => {
            qtd++;
            html += `
      <tr>
         <input type="hidden" name="itemID" value="${item.item_id}" id="itemID${qtd}">
         <td style="border:1px solid #ccc; padding:8px;">
            <input type="text" name="nome" value="${item.nome}" readonly style="width:100%; border:none; background:transparent;">
         </td>
         <td style="border:1px solid #ccc; padding:8px;">
            <input type="number" name="quantidade" value="${item.quantidade}" min="1" style="width:60px;" id="itemQTD${qtd}">
         </td>
      </tr>`;
         });
         html += `
      <tr>
         <td colspan="3" style="padding:8px; text-align:right;">
            <select name="" id="novo-Produto${id}" class="select_status">
               <option value="0" id="opcaoEscolha">ESCOLHA AQUI</option>
               <?php foreach ($produtos as $produto): ?>
            <option value="<?php echo htmlspecialchars($produto['produto_id']); ?>@<?php echo htmlspecialchars($produto['preco']); ?>"><?php echo $produto['nome']; ?></option>
         <?php endforeach; ?>
            </select>
            <input type="number" id="nova-Quantidade" min="1" value="1" style="width:60px; margin-left:8px;" placeholder="Qtd">
            <button type="button" class="w3-button w3-blue" id="btnAdicionarProduto" onclick="adicionarProduto('${id}')" style="margin-left:8px;">
               <i class="fa fa-plus"></i> Adicionar Produto
            </button>
         </td>
      </tr>
         </tbody>
      </table>
      <button class="w3-button w3-green" style="border-radius:8px; font-weight:600;" onclick="qtditemFormulario(${qtd}, ${id})">
         <i class="fa fa-save"></i> Salvar Alterações
      </button>
      `;
      html += `
         </tbody>
      </table>
   </div> 


   <!-- ABA 2: PAGAMENTO -->
   <div id="aba-pagamento" class="tab-content" style="display:none;">
      <h3 style="margin-top:0; color:#2f3a57"><i class="fa fa-money"></i> Editar Pagamento</h3>
      <form id="formPagamento${id}">
         <input type="hidden" name="pedido_id" value="${id}">
         <div style="margin-bottom:12px;">
            <label for="metodo${id}" style="font-weight:600;">Método de Pagamento:</label>
            <select name="metodo" id="metodo${id}" class="select_status" required>
               <option value="">ESCOLHA AQUI</option>
               <?php foreach ($metodos_pagamento as $metodo): ?>
                  <option value="<?php echo htmlspecialchars($metodo['id']); ?>"><?php echo htmlspecialchars($metodo['descricao']); ?></option>
               <?php endforeach; ?>
            </select>
         </div>
         <div style="margin-bottom:12px;">
            <label for="status_pagamento_id${id}" style="font-weight:600;">Status do Pagamento:</label>
            <select name="status_pagamento_id" id="status_pagamento_id${id}" class="select_status" required>
               <option value="">ESCOLHA AQUI</option>
               <?php foreach ($status_pagamento as $status): ?>
                  <option value="<?php echo htmlspecialchars($status['id']); ?>"><?php echo htmlspecialchars($status['descricao']); ?></option>
               <?php endforeach; ?>
            </select>
         </div>
          <div style="margin-bottom:12px;">
            <label for="valor_total${id}" style="font-weight:600;">Valor Total:</label>
            <input type="number" value="${valorTotal.toFixed(2)}" step="0.01" min="0" name="valor_total" id="valor_total${id}" style="width:120px;" required>
         </div>
         <button type="button" class="w3-button w3-green" style="border-radius:8px; font-weight:600;" onclick="salvarPagamento(${id})">
            <i class="fa fa-save"></i> Salvar Pagamento
         </button>
      </form>
   </div> <!-- fim aba-pagamento -->

</div> <!-- fim tabs-container -->
`;
         items.innerHTML = html;
         const modal = document.getElementById('id02');
         modal.style.display = "block";
         window.onclick = function(event) {
            if (event.target === modal) modal.style.display = "none";
         };
      }


/**
 * Função para obter o numero de pedidos novos para utilizar nas notificações
 */

async function contarNotificacoes() {
   let response = await fetch(`/backend/pedidos/notificacoes/1`, {
      method: "GET",
      cache: "no-store"
   });
   const data = await response.json();
   return data.contagem;
}
/**
 * Atualiza a quantidade de pedidos de um tipo
 */
async function atualizarPedido(pedidoId) {
   let response = await fetch(`/backend/pedidos/quantidades/${pedidoId}`, {
      method: "GET",
      cache: "no-store"
   });
   const data = await response.json();
   return data.contagem;
}

/**
 * Busca os pedidos de um tipo
 */
async function buscarPedidos(pedidoId) {
   let response = await fetch(`/backend/pedidos/buscarTipoPedidos/${pedidoId}`, {
      method: "GET",
      cache: "no-store"
   });
   const data = await response.json();
   return data;
}

/**
 * Renderiza o conteúdo dos pedidos na tabela
 */
function renderizarConteudo(conteudo, pedidoId) {
   // 1️⃣ Obter o container
   const container = document.getElementById(`itens${pedidoId}`);
   if (!container) {
      negar.play();
      return;
   }

   // 2️⃣ Validar conteúdo recebido
   const pedidos = Array.isArray(conteudo?.pedidos) ? conteudo.pedidos : [];
   const statusList = Array.isArray(conteudo?.statusPedido) ? conteudo.statusPedido : [];

   // 3️⃣ Limpar container
   container.replaceChildren();

   // 4️⃣ Se não houver pedidos
   if (pedidos.length === 0) {
      const msg = document.createElement("p");
      msg.className = "titulo_carregando";
      msg.textContent = "Nenhum pedido encontrado.";
      container.appendChild(msg);
      return;
   }

   // 5️⃣ Criar estrutura base da tabela
   const wrapper = document.createElement("div");
   wrapper.style.marginTop = "16px";

   const responsiveDiv = document.createElement("div");
   responsiveDiv.className = "w3-responsive card-table";

   const table = document.createElement("table");
   table.className = "w3-table w3-striped w3-white";

   // 6️⃣ Cabeçalho
   const thead = document.createElement("thead");
   thead.className = "table-head";
   thead.innerHTML = `
      <tr>
         <th class="td-tight"><i class="fa fa-hashtag"></i> ID</th>
         <th><i class="fa fa-user"></i> Cliente</th>
         <th class="td-tight"><i class="fa fa-info-circle"></i> Status</th>
         <th class="td-tight"><i class="fa fa-calendar"></i> Data</th>
         <th class="td-tight"><i class="fa fa-list"></i> Tipo Pedido</th>
         <th class="td-tight"><i class="fa fa-cutlery"></i> Itens</th>
         <th class="td-tight"><i class="fa fa-edit"></i> Editar</th>
         <th class="td-tight"><i class="fa fa-trash"></i> Excluir</th>
         <th class="td-tight"><i class="fa fa-refresh"></i> Atualizar Pedido!</th>
      </tr>`;

   // 7️⃣ Corpo da tabela
   const tbody = document.createElement("tbody");

   for (const pedido of pedidos) {
      const tr = document.createElement("tr");
      tr.className = "table-row";

      // Função auxiliar para criar célula
      const td = (html) => {
         const cell = document.createElement("td");
         cell.className = "td-tight";
         if (typeof html === "string") cell.innerHTML = html;
         else cell.appendChild(html);
         return cell;
      };

      // Células
      tr.appendChild(td(`${pedido.pedido_id}`));
      tr.appendChild(td(`<i class="fa fa-user" style="color:#34495e;"></i> <span>${pedido.nome}</span>`));
      tr.appendChild(td(`<span class="badge"><i class="fa"></i> ${pedido.descricao}</span>`));
      tr.appendChild(td(`<i class="fa fa-calendar"></i> ${pedido.criado_em}`));
      tr.appendChild(td(`<i class="fa fa-list"></i> ${pedido.descricao_tipo}`));

      // Botão "Ver Itens"
      const btnView = document.createElement("button");
      btnView.className = "w3-button action-btn btn-view";
      btnView.dataset.id = pedido.pedido_id;
      btnView.title = "Ver itens do pedido";
      btnView.innerHTML = `<i class="fa fa-eye"></i> Ver`;
      btnView.onclick = () => verItensPedidos(pedido.pedido_id);
      tr.appendChild(td(btnView));

      // Botão "Editar"
      const btnEdit = document.createElement("button");
      btnEdit.className = "w3-button w3-blue btn-edit";
      btnEdit.style.cssText = "border-radius:8px; font-weight:600; margin-top:8px;";
      btnEdit.dataset.id = pedido.pedido_id;
      btnEdit.id = `btn${pedido.pedido_id}`;
      btnEdit.innerHTML = `<i class="fa fa-edit"></i> Editar`;
      btnEdit.onclick = () => editarItemsPedidos(pedido.pedido_id);
      tr.appendChild(td(btnEdit));

      // Botão "Excluir"
      const btnDelete = document.createElement("button");
      btnDelete.className = "w3-button action-btn btn-delete";
      btnDelete.dataset.id = pedido.pedido_id;
      btnDelete.id = "botaoExcluir";
      btnDelete.innerHTML = `<i class="fa fa-trash"></i> Excluir`;
      btnDelete.onclick = () => SoftDelete(pedido.pedido_id);
      tr.appendChild(td(btnDelete));

      // Select de status
      let select = document.createElement("select");
      select.className = "select_status";
      select.name = `pedido-status-${pedido.pedido_id}`;
      select.id = `pedido-status-${pedido.pedido_id}`;
      select.onchange = (e) => alterarStatus(e.target.value, pedido.pedido_id);
      
      // Opções
      
      for (const status of statusList) {
         select.appendChild(new Option(status.descricao, status.id));
      }
      
      tr.appendChild(td(select));
      
      tbody.appendChild(tr);
      select.value = pedidoId;
   }
   
   // 8️⃣ Montar hierarquia final
   table.appendChild(thead);
   table.appendChild(tbody);
   responsiveDiv.appendChild(table);
   wrapper.appendChild(responsiveDiv);
   container.appendChild(wrapper);
}  

// ==========================
// Eventos de Tabs e Atualização
// ==========================



//Renderiza o conteudo ao clicar na tab

document.querySelectorAll('.pedidosBusca[data-id]').forEach(btn => {
   btn.addEventListener('click', async () => {

      // Limpar a busca do intervalo de outra Tab
      clearInterval(comparacao);
      const pedidoId = btn.getAttribute('data-id');
      const container = document.getElementById(`itens${pedidoId}`);
      container.innerHTML = `<p class="titulo_carregando"><i class="fa fa-spinner fa-spin"></i> Carregando pedidos...</p>`;
      // Faz a busca do counteudo com base no id da tab
      let conteudo = await buscarPedidos(pedidoId);
      // Renderiza o conteudo na Tab
      renderizarConteudo(conteudo, pedidoId);

      // Guarda a quantidade antiga antes de começar o polling
      let qtdAntiga = conteudo.pedidos.length;

      // Começo do polling
      comparacao = setInterval(async () => {

         // Faz a busca da quantidade atual do banco de dados
         let novaQtd = await atualizarPedido(pedidoId);
         // Comparação entre as quantidades
         if (novaQtd != qtdAntiga) {

            // Caso chegue uma quantidade nova atualizar o conteudo
            let conteudo = await buscarPedidos(pedidoId);
            renderizarConteudo(conteudo, pedidoId);
            qtdAntiga = conteudo.pedidos.length;
   
         }
      }, 5000);
   });
});

// ==========================
// Modais: Editar, Ver, Pagamento/Endereço
// ==========================

/**
 * Modal Editar Itens do Pedido
 */
   async function editarItemsPedidos(id){
      let qtd = 0;
      let dados = await conteudoEditarItensDoPedido(id);
      renderizarEditarItensDoPedido(dados, id, dados.produtos);
   }

/**
 * Modal Ver Itens do Pedido
 */
   async function verItensPedidos(pedidoId) {
      let dados = await fetchDadosPedido(pedidoId);
      renderizarItensDoPedido(dados);
      };


// ==========================
// Fechar Modais
// ==========================
document.querySelectorAll('.modal .close').forEach(btn => {
   btn.onclick = function() {
      btn.closest('.modal').style.display = "none";
   };
});

// ==========================
// Funções de Pedido
// ==========================

/**
 * Soft Delete Pedido
 */
function SoftDelete(idPedido) {
   const data = JSON.stringify({ idPedido });
   const xhr = new XMLHttpRequest();
   xhr.withCredentials = true;
   xhr.open('POST', '/backend/pedidos/deletar');
   xhr.setRequestHeader('Content-Type', 'application/json');
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
         xhr.send(data);
         Swal.fire({
            title: "Deletado!",
            text: "Seu pedido está sendo deletado.",
            icon: "success",
            timerProgressBar: true,
         });
      }
   });
}

/**
 * Soft Delete Item do Pedido
 */
function SoftDeleteItens(itemId, pedidoId) {
   const data = JSON.stringify({ itemId });
   const xhr = new XMLHttpRequest();
   xhr.withCredentials = true;
   xhr.open('POST', '/backend/pedidos/deletarItem');
   xhr.setRequestHeader('Content-Type', 'application/json');
   Swal.fire({
      title: "Você tem certeza?",
      text: "Você ira Remover o Item todo!, Caso queira apenas alterar a quantidade, utilize o campo editar!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Sim, Deletar Item!"
   }).then(async (result) => {
      if (result.isConfirmed) {
         xhr.send(data);
         Swal.fire({
            title: "Deletado!",
            text: "Seu item está sendo deletado.",
            icon: "success",
            timerProgressBar: true,
         });
         let dados = await fetchDadosPedido(pedidoId);
         renderizarItensDoPedido(dados);
      }
   });
}

/**
 * Atualiza quantidade dos itens do pedido
 */
async function qtditemFormulario(qtd,pedidoId) {
   let arrayItems = [];
   for (let index = 1; index <= qtd; index++) {
      let qtdItem = document.getElementById(`itemQTD${index}`).value;
      let IDitem = document.getElementById(`itemID${index}`).value;
      arrayItems.push({ id: IDitem, quantidade: qtdItem });
   }
   const data = JSON.stringify({ itens: arrayItems });
   const xhr = new XMLHttpRequest();
   xhr.withCredentials = true;
   xhr.open('POST', `/backend/pedidos/atualizarItensPedidoQTD`);
   xhr.setRequestHeader('Content-Type', 'application/json');
   Swal.fire({
      title: "Você tem certeza?",
      text: "Você não poderá reverter isso!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Sim, Atualizar Itens!"
   }).then(async(result) => {
      if (result.isConfirmed) {
         xhr.send(data);
         Swal.fire({
            title: "Atualizado!",
            text: "Os itens do pedido estão sendo atualizados.",
            icon: "success",
            timerProgressBar: true,
         });
          let dados = await fetchDadosPedido(pedidoId);
         renderizarItensDoPedido(dados);
      }
   });
}

/**
 * Adiciona produto ao pedido
 */
async function adicionarProduto(pedidoId) {
   const selectProduto = document.getElementById(`novo-Produto${pedidoId}`);
   let dados = await conteudoEditarItensDoPedido(pedidoId);
   qtd = dados.dados2.length;
   if (selectProduto.value === "0") {
      Swal.fire({
         icon: "error",
         title: "Erro",
         text: "Por favor, selecione um produto válido.",
      });
      negar.play();
      return;
   }
   for (let i = 0; i < qtd; i++) {
       if (dados.dados2[i].produto_id === parseInt(selectProduto.value.split("@")[0])) {
         Swal.fire({
            icon: "error",
            title: "Erro",
            text: "Produto já adicionado ao pedido! Por favor, edite a quantidade na tabela.",
         });
         negar.play();
         return;
      }
   }
      const valor = selectProduto.value;
      const quantidade = document.getElementById("nova-Quantidade").value;
      const [produto, preco] = valor.split("@");
      const data = JSON.stringify({
         produtoId: produto,
         idPedido: pedidoId,
         quantidade,
         preco,
      });
      const xhr = new XMLHttpRequest();
      xhr.withCredentials = true;
      xhr.open('POST', '/backend/pedidos/adicionarItensPedido');
      xhr.setRequestHeader('Content-Type', 'application/json');
      Swal.fire({
         title: "Você tem certeza?",
         text: "Você não poderá reverter isso!",
         icon: "warning",
         showCancelButton: true,
         confirmButtonColor: "#3085d6",
         cancelButtonColor: "#d33",
         confirmButtonText: "Sim, Atualizar Produto!"
      }).then( async ( result) => {
         if (result.isConfirmed) {
            xhr.send(data);
            Swal.fire({
               title: "Atualizado!",
               text: "Seu produto está sendo adicionado.",
               icon: "success",
               timerProgressBar: true,
            });
             let dados = await fetchDadosPedido(pedidoId);
             renderizarItensDoPedido(dados);
         }
      });
   }

/**
 * Altera status do pedido
 */
async function alterarStatus(status, idPedido,idStatus) {
   let response = await fetch(`/backend/pedidos/busca/${idPedido}`, { method: "GET" });
   const dados = await response.json();
   if (status === "0") {
      Swal.fire({
         icon: "error",
         title: "Erro",
         text: "Por favor, selecione um status válido.",
      });
      negar.play();
   }else if(dados.dados2[0].status_pedido_id == status){
      Swal.fire({
         icon: "info",
         title: "Info",
         text: "O pedido já está com esse status.",
      });
      negar.play();
      return;
   }
   else {
      const data = JSON.stringify({ status, idPedido });
      const xhr = new XMLHttpRequest();
      xhr.withCredentials = true;
      xhr.open('POST', '/backend/pedidos/atualizarProcesso');
      xhr.setRequestHeader('Content-Type', 'application/json');
      Swal.fire({
         title: "Você tem certeza?",
         text: "Você não poderá reverter isso!",
         icon: "warning",
         showCancelButton: true,
         confirmButtonColor: "#3085d6",
         cancelButtonColor: "#d33",
         confirmButtonText: "Sim, Atualizar Pedido!"
      }).then(async (result) => {
         if (result.isConfirmed) {
            xhr.send(data);
            Swal.fire({
               position: "top-end",
               icon: "success",
               title: "Seu pedido foi atualizado.",
               showConfirmButton: false,
               timerProgressBar: true,
               timer: 1500
            });
            confirmar.play();
            let conteudo = await buscarPedidos(dados.dados2[0].status_pedido_id);
            renderizarConteudo(conteudo, dados.dados2[0].status_pedido_id);
         }
      });
   }
}

// ==========================
// Tabs - Navegação
// ==========================
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
// Abre a aba padrão ao carregar
document.getElementById("defaultOpen").click();





// Funções Apenas para quando a pagina carregar

window.onload = function() {
   setInterval(mostrarNotificacoes, 1500); // Verifica notificações a cada 1.5 segundos
};
function abrirAba(abaId) {

   // 1️⃣ esconder todo o conteúdo
   document.querySelectorAll('.tab-content').forEach(div => {
      div.classList.remove('active');
      div.style.display = "none";
   });

   // 2️⃣ remover active dos botões
   document.querySelectorAll('.tab-btn').forEach(btn => {
      btn.classList.remove('active');
   });

   // 3️⃣ mostrar aba selecionada
   const aba = document.getElementById(abaId);
   if (aba) {
      aba.classList.add('active');
      aba.style.display = "block";
   }

   // 4️⃣ ativar o botão correspondente de forma dinâmica
   const btnAtivo = document.querySelector(`.tab-btn[data-aba="${abaId}"]`);
   if (btnAtivo) btnAtivo.classList.add('active');
}


async function mostrarNotificacoes() {
      let qtdAtual = await contarNotificacoes(); // Verifica novos pedidos
      if (qtdAtual > qtdAnterior) {
         let novosPedidos = qtdAtual - qtdAnterior;
         Swal.fire({
                     position: "top-end",
                     icon: "info",
                     title: "Você tem " + novosPedidos + " novo(s) pedido(s)!",
                     showConfirmButton: false,
                     timer: 3000,
                     timerProgressBar: true,
                  });
                  notificacao.play();
         qtdAnterior = qtdAtual;
      }
      qtdAnterior = qtdAtual;
   }
</script>


<script src="/assets/js/notificacao.js"></script>