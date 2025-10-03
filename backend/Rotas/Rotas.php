<?php

namespace App\Tadala\Rotas;

class Rotas
{
    public static function get()
    {
        return [
            'GET' => [

                // --------------------------
                // Usuarios
                // --------------------------
                "/backend/usuario"               => "UsuarioController@index",
                "/backend/usuario/criar"         => "UsuarioController@viewCriarUsuario",
                "/backend/usuario/editar"        => "UsuarioController@viewEditarUsuario",
                "/backend/usuario/excluir"       => "UsuarioController@viewExcluirUsuario",
                "/backend/usuario/listar"        => "UsuarioController@viewListarUsuario",

                // --------------------------
                // Tipo Usuario (dominio)
                // --------------------------
                "/backend/tipoUsuario"           => "TipoUsuarioController@index",
                "/backend/tipoUsuario/criar"     => "TipoUsuarioController@viewCriarTipoUsuario",
                "/backend/tipoUsuario/editar"    => "TipoUsuarioController@viewEditarTipoUsuario",
                "/backend/tipoUsuario/excluir"   => "TipoUsuarioController@viewExcluirTipoUsuario",
                "/backend/tipoUsuario/listar"    => "TipoUsuarioController@viewListarTipoUsuario",

                // --------------------------
                // Status Pedido (dominio)
                // --------------------------
                "/backend/statusPedido"          => "StatusPedidoController@index",
                "/backend/statusPedido/criar"    => "StatusPedidoController@viewCriarStatusPedido",
                "/backend/statusPedido/editar"   => "StatusPedidoController@viewEditarStatusPedido",
                "/backend/statusPedido/excluir"  => "StatusPedidoController@viewExcluirStatusPedido",
                "/backend/statusPedido/listar"   => "StatusPedidoController@viewListarStatusPedido",

                // --------------------------
                // Status Pagamento (dominio)
                // --------------------------
                "/backend/statusPagamento"       => "StatusPagamentoController@index",
                "/backend/statusPagamento/criar" => "StatusPagamentoController@viewCriarStatusPagamento",
                "/backend/statusPagamento/editar" => "StatusPagamentoController@viewEditarStatusPagamento",
                "/backend/statusPagamento/excluir" => "StatusPagamentoController@viewExcluirStatusPagamento",
                "/backend/statusPagamento/listar" => "StatusPagamentoController@viewListarStatusPagamento",

                // --------------------------
                // Status Funcionario (dominio)
                // --------------------------
                "/backend/statusFuncionario"          => "StatusFuncionarioController@index",
                "/backend/statusFuncionario/criar"    => "StatusFuncionarioController@viewCriarStatusFuncionario",
                "/backend/statusFuncionario/editar"   => "StatusFuncionarioController@viewEditarStatusFuncionario",
                "/backend/statusFuncionario/excluir"  => "StatusFuncionarioController@viewExcluirStatusFuncionario",
                "/backend/statusFuncionario/listar"   => "StatusFuncionarioController@viewListarStatusFuncionario",

                // --------------------------
                // Promocoes
                // --------------------------
                "/backend/promocoes"            => "PromocoesController@index",
                "/backend/promocoes/criar"      => "PromocoesController@viewCriarPromocao",
                "/backend/promocoes/editar"     => "PromocoesController@viewEditarPromocao",
                "/backend/promocoes/excluir"    => "PromocoesController@viewExcluirPromocao",
                "/backend/promocoes/listar"     => "PromocoesController@viewListarPromocoes",

                // --------------------------
                // Produtos
                // --------------------------
                "/backend/produtos"             => "ProdutosController@index",
                "/backend/produtos/criar"       => "ProdutosController@viewCriarProduto",
                "/backend/produtos/editar"      => "ProdutosController@viewEditarProduto",
                "/backend/produtos/excluir"     => "ProdutosController@viewExcluirProduto",
                "/backend/produtos/listar"      => "ProdutosController@viewListarProdutos",

                // --------------------------
                // Pedidos
                // --------------------------
                "/backend/pedidos"              => "PedidosController@index",
                "/backend/pedidos/criar"        => "PedidosController@viewCriarPedido",
                "/backend/pedidos/editar"       => "PedidosController@viewEditarPedido",
                "/backend/pedidos/excluir"      => "PedidosController@viewExcluirPedido",
                "/backend/pedidos/listar"       => "PedidosController@viewListarPedidos",

                // --------------------------
                // Pagamento
                // --------------------------
                "/backend/pagamento"            => "PagamentoController@index",
                "/backend/pagamento/criar"      => "PagamentoController@viewCriarPagamento",
                "/backend/pagamento/editar"     => "PagamentoController@viewEditarPagamento",
                "/backend/pagamento/excluir"    => "PagamentoController@viewExcluirPagamento",
                "/backend/pagamento/listar"     => "PagamentoController@viewListarPagamento",

                // --------------------------
                // Itens Pedidos
                // --------------------------
                "/backend/itensPedidos"         => "ItensPedidosController@index",
                "/backend/itensPedidos/criar"   => "ItensPedidosController@viewCriarItemPedido",
                "/backend/itensPedidos/editar"  => "ItensPedidosController@viewEditarItemPedido",
                "/backend/itensPedidos/excluir" => "ItensPedidosController@viewExcluirItemPedido",
                "/backend/itensPedidos/listar"  => "ItensPedidosController@viewListarItensPedidos",

                // --------------------------
                // Funcionarios
                // --------------------------
                "/backend/funcionarios"         => "FuncionariosController@index",
                "/backend/funcionarios/criar"   => "FuncionariosController@viewCriarFuncionario",
                "/backend/funcionarios/editar"  => "FuncionariosController@viewEditarFuncionario",
                "/backend/funcionarios/excluir" => "FuncionariosController@viewExcluirFuncionario",
                "/backend/funcionarios/listar"  => "FuncionariosController@viewListarFuncionarios",

                // --------------------------
                // Endereco
                // --------------------------
                "/backend/endereco"             => "EnderecoController@index",
                "/backend/endereco/criar"       => "EnderecoController@viewCriarEndereco",
                "/backend/endereco/editar"      => "EnderecoController@viewEditarEndereco",
                "/backend/endereco/excluir"     => "EnderecoController@viewExcluirEndereco",
                "/backend/endereco/listar"      => "EnderecoController@viewListarEndereco",

                // --------------------------
                // Categoria
                // --------------------------
                "/backend/categoria"            => "CategoriaController@index",
                "/backend/categoria/criar"      => "CategoriaController@viewCriarCategoria",
                "/backend/categoria/editar"     => "CategoriaController@viewEditarCategoria",
                "/backend/categoria/excluir"    => "CategoriaController@viewExcluirCategoria",
                "/backend/categoria/listar"     => "CategoriaController@viewListarCategoria",

                // --------------------------
                // Cargo (dominio)
                // --------------------------
                "/backend/cargo"                => "CargoController@index",
                "/backend/cargo/criar"          => "CargoController@viewCriarCargo",
                "/backend/cargo/editar"         => "CargoController@viewEditarCargo",
                "/backend/cargo/excluir"        => "CargoController@viewExcluirCargo",
                "/backend/cargo/listar"         => "CargoController@viewListarCargo",

                // --------------------------
                // Agendamento
                // --------------------------
                "/backend/agendamento"          => "AgendamentoController@index",
                "/backend/agendamento/criar"    => "AgendamentoController@viewCriarAgendamento",
                "/backend/agendamento/editar"   => "AgendamentoController@viewEditarAgendamento",
                "/backend/agendamento/excluir"  => "AgendamentoController@viewExcluirAgendamento",
                "/backend/agendamento/listar"   => "AgendamentoController@viewListarAgendamento",
            ],

            'POST' => [

                // Usuarios
                "/backend/usuario/salvar"       => "UsuarioController@salvarUsuario",
                "/backend/usuario/atualizar"    => "UsuarioController@atualizarUsuario",
                "/backend/usuario/deletar"      => "UsuarioController@deletarUsuario",

                // TipoUsuario
                "/backend/tipoUsuario/salvar"   => "TipoUsuarioController@salvarTipoUsuario",
                "/backend/tipoUsuario/atualizar" => "TipoUsuarioController@atualizarTipoUsuario",
                "/backend/tipoUsuario/deletar"  => "TipoUsuarioController@deletarTipoUsuario",

                // StatusPedido
                "/backend/statusPedido/salvar"  => "StatusPedidoController@salvarStatusPedido",
                "/backend/statusPedido/atualizar" => "StatusPedidoController@atualizarStatusPedido",
                "/backend/statusPedido/deletar" => "StatusPedidoController@deletarStatusPedido",

                // StatusPagamento
                "/backend/statusPagamento/salvar"  => "StatusPagamentoController@salvarStatusPagamento",
                "/backend/statusPagamento/atualizar" => "StatusPagamentoController@atualizarStatusPagamento",
                "/backend/statusPagamento/deletar" => "StatusPagamentoController@deletarStatusPagamento",

                // StatusFuncionario
                "/backend/statusFuncionario/salvar"  => "StatusFuncionarioController@salvarStatusFuncionario",
                "/backend/statusFuncionario/atualizar" => "StatusFuncionarioController@atualizarStatusFuncionario",
                "/backend/statusFuncionario/deletar" => "StatusFuncionarioController@deletarStatusFuncionario",

                // Promocoes
                "/backend/promocoes/salvar"     => "PromocoesController@salvarPromocao",
                "/backend/promocoes/atualizar"  => "PromocoesController@atualizarPromocao",
                "/backend/promocoes/deletar"    => "PromocoesController@deletarPromocao",

                // Produtos
                "/backend/produtos/salvar"      => "ProdutosController@salvarProduto",
                "/backend/produtos/atualizar"   => "ProdutosController@atualizarProduto",
                "/backend/produtos/deletar"     => "ProdutosController@deletarProduto",

                // Pedidos
                "/backend/pedidos/salvar"       => "PedidosController@salvarPedido",
                "/backend/pedidos/atualizar"    => "PedidosController@atualizarPedido",
                "/backend/pedidos/deletar"      => "PedidosController@deletarPedido",

                // Pagamento
                "/backend/pagamento/salvar"     => "PagamentoController@salvarPagamento",
                "/backend/pagamento/atualizar"  => "PagamentoController@atualizarPagamento",
                "/backend/pagamento/deletar"    => "PagamentoController@deletarPagamento",

                // Itens Pedidos
                "/backend/itensPedidos/salvar"  => "ItensPedidosController@salvarItemPedido",
                "/backend/itensPedidos/atualizar" => "ItensPedidosController@atualizarItemPedido",
                "/backend/itensPedidos/deletar" => "ItensPedidosController@deletarItemPedido",

                // Funcionarios
                "/backend/funcionarios/salvar"  => "FuncionariosController@salvarFuncionario",
                "/backend/funcionarios/atualizar" => "FuncionariosController@atualizarFuncionario",
                "/backend/funcionarios/deletar" => "FuncionariosController@deletarFuncionario",

                // Endereco
                "/backend/endereco/salvar"      => "EnderecoController@salvarEndereco",
                "/backend/endereco/atualizar"   => "EnderecoController@atualizarEndereco",
                "/backend/endereco/deletar"     => "EnderecoController@deletarEndereco",

                // Categoria
                "/backend/categoria/salvar"     => "CategoriaController@salvarCategoria",
                "/backend/categoria/atualizar"  => "CategoriaController@atualizarCategoria",
                "/backend/categoria/deletar"    => "CategoriaController@deletarCategoria",

                // Cargo
                "/backend/cargo/salvar"         => "CargoController@salvarCargo",
                "/backend/cargo/atualizar"      => "CargoController@atualizarCargo",
                "/backend/cargo/deletar"        => "CargoController@deletarCargo",

                // Agendamento
                "/backend/agendamento/salvar"   => "AgendamentoController@salvarAgendamento",
                "/backend/agendamento/atualizar" => "AgendamentoController@atualizarAgendamento",
                "/backend/agendamento/deletar"  => "AgendamentoController@deletarAgendamento",
            ]
        ];
    }
}
