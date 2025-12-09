import central from "../../central.js";
let principal = new central();


export async function renderizarItensDoPedido(pedidoId, usuarioId) {
      const items = document.getElementById('itemsPedidos');
      let dados = await principal.FetchDadosGlobal(`busca/${pedidoId}`, "GET","pedidos");
      let qtd = 0;
      let html = `
         <div id="aba-ver" class="tab-content active">
            <h3 style="margin-top:0; color:#2f3a57">
               <i class="fa fa-cutlery"></i> Detalhes do Pedido
            </h3>
      `;
      if (dados.tipoPedido.tipo_pedido === 3) {
         let enderecoDados = await principal.FetchDadosGlobal(`buscaEndereco/${usuarioId}`, "GET","pedidos");
         html += `
            <h4 style="color:#2f3a57; margin-top:15px;">
               <i class="fa fa-map-marker"></i> Endereço de Entrega
            </h4>
            <ul class="details-list">
               <li><strong>Rua:</strong> ${enderecoDados.endereco.rua}, Nº ${enderecoDados.endereco.numero}</li>
               <li><strong>Bairro:</strong> ${enderecoDados.endereco.bairro}</li>
               <li><strong>Cidade:</strong> ${enderecoDados.endereco.cidade} - ${enderecoDados.endereco.estado}</li>
               <li><strong>CEP:</strong> ${enderecoDados.endereco.cep}</li>
            </ul>
         `;
      }
      html += `
            <table class="table-default">
               <thead>
                  <tr>
                     <th>Produto</th>
                     <th>Quantidade</th>
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
         html += `
            <tr>
               <input type="hidden" id="itemID${qtd}" value="${item.item_id}" min="1">
               <td>${item.nome}</td>
               <td>
                  <input type="number" min="1" class="input-number" id="itemQTD${qtd}" value="${item.quantidade}">
               </td>
               <td>R$ ${Number(item.valor_unitario).toFixed(2)}</td>
               <td>R$ ${subtotal.toFixed(2)}</td>
               <td>
                  <button class="btn-delete" onclick="SoftDeleteItens(${item.item_id}, ${pedidoId})">
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
                     <option value="0">ESCOLHA O PRODUTO</option>`;
      dados.produtos.forEach(produto => {
         html += `<option value="${produto.produto_id}@${produto.preco}">${produto.nome}</option>`;
      });
      html += `
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
            <h4 style="margin-top:18px; color:#2f3a57"><i class="fa fa-credit-card"></i> Pagamento</h4>
            <ul class="details-list">
               <li><input type="hidden" id="valor_total${pedidoId}" value="${dados.valorTotal}"><strong>Valor Total:</strong> R$ ${dados.valorTotal}</li>
               <li><strong>Status:</strong><select id="status_pagamento_id${pedidoId}" class="select_status" style="max-width:240px;">`;
      dados.statusPagamento.forEach(status => {
         html += `<option value="${status.id}">${status.descricao}</option>`;
      });
      html += `</select></li>
               <li><strong>Método:</strong><select id="pagamentoMetodo${pedidoId}" class="select_status" style="max-width:240px;">`;
      dados.metodoPagamento.forEach(pagamento => {
         html += `<option value="${pagamento.id}">${pagamento.descricao_metodo}</option>`;
      });
      html += `</select></li>
            </ul>
            <button class="btn-primary" onclick="atualizarFormulario(${pedidoId}, ${qtd})">
               <i class="fa fa-save"></i> Salvar Alterações
            </button>
         </div>
      `;
      items.innerHTML = html;
      const modal = document.getElementById('id01');
      document.getElementById(`pagamentoMetodo${pedidoId}`).value = `${dados.buscarMetodoPagamento.metodo}`;
      document.getElementById(`status_pagamento_id${pedidoId}`).value = `${dados.buscarMetodoPagamento.status_pagamento_id}`;
      modal.style.display = "block";
      window.onclick = function(event) {
         if (event.target === modal) modal.style.display = "none";
      };
   }
