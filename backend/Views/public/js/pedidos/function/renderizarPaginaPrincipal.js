import central from "../../central.js";
let principal = new central();



export async function renderizarConteudo(pedidoId, dados, produtos) {
   const pedidos = dados.pedidos.filter(pedido => pedido.status_pedido_id === parseInt(pedidoId));

   const container = document.getElementById(`itens${pedidoId}`);     
   if (!container) return;
   const statusList = Array.isArray(dados?.statusPedido) ? dados.statusPedido : [];
   container.replaceChildren();
   if (pedidos.length === 0) {
      const msg = document.createElement("p");
      msg.className = "titulo_carregando";
      msg.textContent = "Nenhum pedido encontrado.";
      container.appendChild(msg);
      return;
   }

   const wrapper = document.createElement("div");
   wrapper.style.marginTop = "16px";
   const responsiveDiv = document.createElement("div");
   responsiveDiv.className = "w3-responsive card-table";
   const table = document.createElement("table");
   table.className = "w3-table w3-striped w3-white";

   // Cabeçalho
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
         <th class="td-tight"><i class="fa fa-trash"></i> Excluir</th>
         <th class="td-tight"><i class="fa fa-refresh"></i> Atualizar Pedido!</th>
      </tr>`;
   const tbody = document.createElement("tbody");

   for (const pedido of pedidos) {
      const tr = document.createElement("tr");
      tr.className = "table-row";
      const td = (html) => {
         const cell = document.createElement("td");
         cell.className = "td-tight";
         if (typeof html === "string") cell.innerHTML = html;
         else cell.appendChild(html);
         return cell;
      };
      tr.appendChild(td(`${pedido.pedido_id}`));
      tr.appendChild(td(`<i class="fa fa-user" style="color:#34495e;"></i> <span>${pedido.nome}</span>`));
      tr.appendChild(td(`<span class="badge"><i class="fa"></i> ${pedido.descricao}</span>`));
      tr.appendChild(td(`<i class="fa fa-calendar"></i> ${pedido.criado_em}`));
      tr.appendChild(td(`<i class="fa fa-list"></i> ${pedido.descricao_tipo}`));

      // Botão "Ver Itens"
      const btnView = document.createElement("button");
      btnView.className = "w3-button action-btn btn-view botaoVerItens";
      btnView.dataset.id = pedido.pedido_id;
      btnView.dataset.usuarioId = pedido.usuario_id;
      btnView.dataset.produtosAtivos = produtos
      btnView.title = "Ver itens do pedido";
      btnView.innerHTML = `<i class="fa fa-eye"></i> Ver`;
      tr.appendChild(td(btnView));

      // Botão "Excluir"
      const btnDelete = document.createElement("button");
      btnDelete.className = "w3-button action-btn btn-delete deletarPedido";
      btnDelete.dataset.id = pedido.pedido_id;
      btnDelete.dataset.status = pedidoId
      btnDelete.id = "botaoExcluir";
      btnDelete.innerHTML = `<i class="fa fa-trash"></i> Excluir`;
      tr.appendChild(td(btnDelete));

      // Select de status
      let select = document.createElement("select");
      select.className = "select_status_pedido select_status";
      select.name = `pedido-status-${pedido.pedido_id}`;
      select.id = `pedido-status-${pedido.pedido_id}`;
      select.dataset.valorAtualTab = pedidoId;
      select.dataset.pedidoId = pedido.pedido_id;
      for (const status of statusList) {
         select.appendChild(new Option(status.descricao, status.id));
      }
      tr.appendChild(td(select));
      tbody.appendChild(tr);
      select.value = pedidoId;
   }
   table.appendChild(thead);
   table.appendChild(tbody);
   responsiveDiv.appendChild(table);
   wrapper.appendChild(responsiveDiv);
   container.appendChild(wrapper);
    }


