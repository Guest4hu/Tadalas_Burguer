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
                "/usuario"               => "UsuarioController@index",
                "/usuario/criar"         => "UsuarioController@viewCriarUsuario",
                "/usuario/editar/{id}"        => "UsuarioController@viewEditarUsuario",
                "/usuario/excluir/{id}"       => "UsuarioController@viewExcluirUsuario",
                "/usuario/listar/{id}"        => "UsuarioController@viewListarUsuario",

                // --------------------------
                // Tipo Usuario (dominio)
                // --------------------------
                "/tipoUsuario"           => "TipoUsuarioController@index",
                "/tipoUsuario/criar"     => "TipoUsuarioController@viewCriarTipoUsuario",
                "/tipoUsuario/editar/{id}"    => "TipoUsuarioController@viewEditarTipoUsuario",
                "/tipoUsuario/excluir/{id}"   => "TipoUsuarioController@viewExcluirTipoUsuario",
                "/tipoUsuario/listar/{id}"    => "TipoUsuarioController@viewListarTipoUsuario",

                // --------------------------
                // Status Pedido (dominio)
                // --------------------------
                "/statusPedido"          => "StatusPedidoController@index",
                "/statusPedido/criar"    => "StatusPedidoController@viewCriarStatusPedido",
                "/statusPedido/editar/{id}"   => "StatusPedidoController@viewEditarStatusPedido",
                "/statusPedido/excluir/{id}"  => "StatusPedidoController@viewExcluirStatusPedido",
                "/statusPedido/listar/{id}"   => "StatusPedidoController@viewListarStatusPedido",

                // --------------------------
                // Status Pagamento (dominio)
                // --------------------------
                "/statusPagamento"       => "StatusPagamentoController@index",
                "/statusPagamento/criar" => "StatusPagamentoController@viewCriarStatusPagamento",
                "/statusPagamento/editar/{id}" => "StatusPagamentoController@viewEditarStatusPagamento",
                "/statusPagamento/excluir/{id}" => "StatusPagamentoController@viewExcluirStatusPagamento",
                "/statusPagamento/listar/{id}" => "StatusPagamentoController@viewListarStatusPagamento",

                // --------------------------
                // Status Funcionario (dominio)
                // --------------------------
                "/statusFuncionario"          => "StatusFuncionarioController@index",
                "/statusFuncionario/criar"    => "StatusFuncionarioController@viewCriarStatusFuncionario",
                "/statusFuncionario/editar/{id}"   => "StatusFuncionarioController@viewEditarStatusFuncionario",
                "/statusFuncionario/excluir/{id}"  => "StatusFuncionarioController@viewExcluirStatusFuncionario",
                "/statusFuncionario/listar/{id}"   => "StatusFuncionarioController@viewListarStatusFuncionario",

                // --------------------------
                // Promocoes
                // --------------------------
                "/promocoes"            => "PromocoesController@index",
                "/promocoes/criar"      => "PromocoesController@viewCriarPromocao",
                "/promocoes/editar/{id}"     => "PromocoesController@viewEditarPromocao",
                "/promocoes/excluir/{id}"    => "PromocoesController@viewExcluirPromocao",
                "/promocoes/listar/{id}"     => "PromocoesController@viewListarPromocoes",

                // --------------------------
                // Produtos
                // --------------------------
                "/produtos"             => "ProdutosController@index",
                "/produtos/criar"       => "ProdutosController@viewCriarProduto",
                "/produtos/editar/{id}"      => "ProdutosController@viewEditarProduto",
                "/produtos/excluir/{id}"     => "ProdutosController@viewExcluirProduto",
                "/produtos/listar/{id}"      => "ProdutosController@viewListarProdutos",

                // --------------------------
                // Pedidos
                // --------------------------
                "/pedidos"              => "PedidosController@index",
                "/pedidos/criar"        => "PedidosController@viewCriarPedido",
                "/pedidos/editar/{id}"       => "PedidosController@viewEditarPedido",
                "/pedidos/excluir/{id}"      => "PedidosController@viewExcluirPedido",
                "/pedidos/listar/{id}"       => "PedidosController@viewListarPedidos",

                // --------------------------
                // Pagamento
                // --------------------------
                "/pagamento"            => "PagamentoController@index",
                "/pagamento/criar"      => "PagamentoController@viewCriarPagamento",
                "/pagamento/editar/{id}"     => "PagamentoController@viewEditarPagamento",
                "/pagamento/excluir/{id}"    => "PagamentoController@viewExcluirPagamento",
                "/pagamento/listar/{id}"     => "PagamentoController@viewListarPagamento",

                // --------------------------
                // Itens Pedidos
                // --------------------------
                "/itensPedidos"         => "ItensPedidosController@index",
                "/itensPedidos/criar"   => "ItensPedidosController@viewCriarItemPedido",
                "/itensPedidos/editar/{id}"  => "ItensPedidosController@viewEditarItemPedido",
                "/itensPedidos/excluir/{id}" => "ItensPedidosController@viewExcluirItemPedido",
                "/itensPedidos/listar/{id}"  => "ItensPedidosController@viewListarItensPedidos",

                // --------------------------
                // Funcionarios
                // --------------------------
                "/funcionarios"         => "FuncionariosController@index",
                "/funcionarios/criar"   => "FuncionariosController@viewCriarFuncionario",
                "/funcionarios/editar/{id}"  => "FuncionariosController@viewEditarFuncionario",
                "/funcionarios/excluir/{id}" => "FuncionariosController@viewExcluirFuncionario",
                "/funcionarios/listar/{id}"  => "FuncionariosController@viewListarFuncionarios",

                // --------------------------
                // Endereco
                // --------------------------
                "/endereco"             => "EnderecoController@index",
                "/endereco/criar"       => "EnderecoController@viewCriarEndereco",
                "/endereco/editar/{id}"      => "EnderecoController@viewEditarEndereco",
                "/endereco/excluir/{id}"     => "EnderecoController@viewExcluirEndereco",
                "/endereco/listar/{id}"      => "EnderecoController@viewListarEndereco",

                // --------------------------
                // Categoria
                // --------------------------
                "/categoria"            => "CategoriaController@index",
                "/categoria/criar"      => "CategoriaController@viewCriarCategoria",
                "/categoria/editar/{id}"     => "CategoriaController@viewEditarCategoria",
                "/categoria/excluir/{id}"    => "CategoriaController@viewExcluirCategoria",
                "/categoria/listar/{id}"     => "CategoriaController@viewListarCategoria",

                // --------------------------
                // Cargo (dominio)
                // --------------------------
                "/cargo"                => "CargoController@index",
                "/cargo/criar"          => "CargoController@viewCriarCargo",
                "/cargo/editar/{id}"         => "CargoController@viewEditarCargo",
                "/cargo/excluir/{id}"        => "CargoController@viewExcluirCargo",
                "/cargo/listar/{id}"         => "CargoController@viewListarCargo",

                // --------------------------
                // Agendamento
                // --------------------------
                "/agendamento"          => "AgendamentoController@index",
                "/agendamento/criar"    => "AgendamentoController@viewCriarAgendamento",
                "/agendamento/editar/{id}"   => "AgendamentoController@viewEditarAgendamento",
                "/agendamento/excluir/{id}"  => "AgendamentoController@viewExcluirAgendamento",
                "/agendamento/listar/{id}"   => "AgendamentoController@viewListarAgendamento",
            ],

            'POST' => [

                // Usuarios
                "/usuario/salvar"       => "UsuarioController@salvarUsuario",
                "/usuario/atualizar"    => "UsuarioController@atualizarUsuario",
                "/usuario/deletar"      => "UsuarioController@deletarUsuario",

                // TipoUsuario
                "/tipoUsuario/salvar"   => "TipoUsuarioController@salvarTipoUsuario",
                "/tipoUsuario/atualizar" => "TipoUsuarioController@atualizarTipoUsuario",
                "/tipoUsuario/deletar"  => "TipoUsuarioController@deletarTipoUsuario",

                // StatusPedido
                "/statusPedido/salvar"  => "StatusPedidoController@salvarStatusPedido",
                "/statusPedido/atualizar" => "StatusPedidoController@atualizarStatusPedido",
                "/statusPedido/deletar" => "StatusPedidoController@deletarStatusPedido",

                // StatusPagamento
                "/statusPagamento/salvar"  => "StatusPagamentoController@salvarStatusPagamento",
                "/statusPagamento/atualizar" => "StatusPagamentoController@atualizarStatusPagamento",
                "/statusPagamento/deletar" => "StatusPagamentoController@deletarStatusPagamento",

                // StatusFuncionario
                "/statusFuncionario/salvar"  => "StatusFuncionarioController@salvarStatusFuncionario",
                "/statusFuncionario/atualizar" => "StatusFuncionarioController@atualizarStatusFuncionario",
                "/statusFuncionario/deletar" => "StatusFuncionarioController@deletarStatusFuncionario",

                // Promocoes
                "/promocoes/salvar"     => "PromocoesController@salvarPromocao",
                "/promocoes/atualizar"  => "PromocoesController@atualizarPromocao",
                "/promocoes/deletar"    => "PromocoesController@deletarPromocao",

                // Produtos
                "/produtos/salvar"      => "ProdutosController@salvarProduto",
                "/produtos/atualizar"   => "ProdutosController@atualizarProduto",
                "/produtos/deletar"     => "ProdutosController@deletarProduto",

                // Pedidos
                "/pedidos/salvar"       => "PedidosController@salvarPedido",
                "/pedidos/atualizar"    => "PedidosController@atualizarPedido",
                "/pedidos/deletar"      => "PedidosController@deletarPedido",

                // Pagamento
                "/pagamento/salvar"     => "PagamentoController@salvarPagamento",
                "/pagamento/atualizar"  => "PagamentoController@atualizarPagamento",
                "/pagamento/deletar"    => "PagamentoController@deletarPagamento",

                // Itens Pedidos
                "/itensPedidos/salvar"  => "ItensPedidosController@salvarItemPedido",
                "/itensPedidos/atualizar" => "ItensPedidosController@atualizarItemPedido",
                "/itensPedidos/deletar" => "ItensPedidosController@deletarItemPedido",

                // Funcionarios
                "/funcionarios/salvar"  => "FuncionariosController@salvarFuncionario",
                "/funcionarios/atualizar" => "FuncionariosController@atualizarFuncionario",
                "/funcionarios/deletar" => "FuncionariosController@deletarFuncionario",

                // Endereco
                "/endereco/salvar"      => "EnderecoController@salvarEndereco",
                "/endereco/atualizar"   => "EnderecoController@atualizarEndereco",
                "/endereco/deletar"     => "EnderecoController@deletarEndereco",

                // Categoria
                "/categoria/salvar"     => "CategoriaController@salvarCategoria",
                "/categoria/atualizar"  => "CategoriaController@atualizarCategoria",
                "/categoria/deletar"    => "CategoriaController@deletarCategoria",

                // Cargo
                "/cargo/salvar"         => "CargoController@salvarCargo",
                "/cargo/atualizar"      => "CargoController@atualizarCargo",
                "/cargo/deletar"        => "CargoController@deletarCargo",

                // Agendamento
                "/agendamento/salvar"   => "AgendamentoController@salvarAgendamento",
                "/agendamento/atualizar" => "AgendamentoController@atualizarAgendamento",
                "/agendamento/deletar"  => "AgendamentoController@deletarAgendamento",
            ]
        ];
    }
}
