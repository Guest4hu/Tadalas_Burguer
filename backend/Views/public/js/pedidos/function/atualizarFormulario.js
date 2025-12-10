import central from "../central.js";
import { atualizarPagamento } from "./atualizarPagamento.js";
import {  } from "rende";

let principal = new central();




export async function atualizarFormulario(pedidoId, qtd) {
    if (await principal.alertaConfirmacao("Atualizar?","Tem certeza que deseja atualizar o formulario?","icon") === true) {
        principal.abrirCarregar();
        await qtditemFormulario(qtd, pedidoId);
        await atualizarPagamento(pedidoId);
        await renderizarItensDoPedido(pedidoId);
        principal.fecharCarregar("success","Atualizado!");
        return
    }
    return
}