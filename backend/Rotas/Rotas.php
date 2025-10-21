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
                "/usuario"               => "UsuarioController@viewListarUsuario",
                "/usuario/criar"         => "UsuarioController@viewCriarUsuario",
                "/usuario/editar/{id}"        => "UsuarioController@viewEditarUsuario",
                "/usuario/excluir/{id}"       => "UsuarioController@viewExcluirUsuario",
                "/usuario/listar/{id}"        => "UsuarioController@viewListarUsuario",

                // --------------------------
                // Tipo Usuario (dominio)
                // --------------------------
                "/tipoUsuario"           => "TipoUsuarioController@viewListarTipoUsuario",
                "/tipoUsuario/criar"     => "TipoUsuarioController@viewCriarTipoUsuario",
                "/tipoUsuario/editar/{id}"    => "TipoUsuarioController@viewEditarTipoUsuario",
                "/tipoUsuario/excluir/{id}"   => "TipoUsuarioController@viewExcluirTipoUsuario",
                "/tipoUsuario/listar/{id}"    => "TipoUsuarioController@viewListarTipoUsuario",

                // --------------------------
                // Status Pedido (dominio)
                // --------------------------
                "/statusPedido"          => "StatusPedidoController@viewListarStatusPedido",
                "/statusPedido/criar"    => "StatusPedidoController@viewCriarStatusPedido",
                "/statusPedido/editar/{id}"   => "StatusPedidoController@viewEditarStatusPedido",
                "/statusPedido/excluir/{id}"  => "StatusPedidoController@viewExcluirStatusPedido",
                "/statusPedido/listar/{id}"   => "StatusPedidoController@viewListarStatusPedido",

                // --------------------------
                // Status Pagamento (dominio)
                // --------------------------
                "/statusPagamento"       => "StatusPagamentoController@viewListarStatusPagamento",
                "/statusPagamento/criar" => "StatusPagamentoController@viewCriarStatusPagamento",
                "/statusPagamento/editar/{id}" => "StatusPagamentoController@viewEditarStatusPagamento",
                "/statusPagamento/excluir/{id}" => "StatusPagamentoController@viewExcluirStatusPagamento",
                "/statusPagamento/listar/{id}" => "StatusPagamentoController@viewListarStatusPagamento",

                // --------------------------
                // Status Funcionario (dominio)
                // --------------------------
                "/statusFuncionario"          => "StatusFuncionarioController@viewListarStatusFuncionario",
                "/statusFuncionario/criar"    => "StatusFuncionarioController@viewCriarStatusFuncionario",
                "/statusFuncionario/editar/{id}"   => "StatusFuncionarioController@viewEditarStatusFuncionario",
                "/statusFuncionario/excluir/{id}"  => "StatusFuncionarioController@viewExcluirStatusFuncionario",
                "/statusFuncionario/listar/{id}"   => "StatusFuncionarioController@viewListarStatusFuncionario",

                // --------------------------
                // Promocoes
                // --------------------------
                "/promocoes"            => "PromocoesController@viewListarPromocoes",
                "/promocoes/criar"      => "PromocoesController@viewCriarPromocoes",
                "/promocoes/editar/{id}"     => "PromocoesController@viewEditarPromocoes",
                "/promocoes/excluir/{id}"    => "PromocoesController@viewExcluirPromocoes",
                "/promocoes/listar/{id}"     => "PromocoesController@viewListarPromocoes",

                // --------------------------
                // Produtos
                // --------------------------
                "/produtos"             => "ProdutosController@viewListarProdutos",
                "/produtos/criar"       => "ProdutosController@viewCriarProduto",
                "/produtos/editar/{id}"      => "ProdutosController@viewEditarProduto",
                "/produtos/excluir/{id}"     => "ProdutosController@viewExcluirProduto",
                "/produtos/listar/{id}"      => "ProdutosController@viewListarProdutos",

                // --------------------------
                // Pedidos
                // --------------------------
                "/pedidos"              => "PedidosController@viewListarPedidos",
                "/pedidos/criar"        => "PedidosController@viewCriarPedidos",
                "/pedidos/editar/{id}"       => "PedidosController@viewEditarPedidos",
                "/pedidos/excluir/{id}"      => "PedidosController@viewExcluirPedidos",
                "/pedidos/listar/{id}"       => "PedidosController@viewListarPedidos",

                // --------------------------
                // Pagamento
                // --------------------------
                "/pagamento"            => "PagamentoController@viewListarPagamento",
                "/pagamento/criar"      => "PagamentoController@viewCriarPagamento",
                "/pagamento/editar/{id}"     => "PagamentoController@viewEditarPagamento",
                "/pagamento/excluir/{id}"    => "PagamentoController@viewExcluirPagamento",
                "/pagamento/listar/{id}"     => "PagamentoController@viewListarPagamento",

                // --------------------------
                // Itens Pedidos
                // --------------------------
                "/itensPedidos"         => "ItensPedidosController@viewListarItensPedido",
                "/itensPedidos/criar"   => "ItensPedidosController@viewCriarItemPedido",
                "/itensPedidos/editar/{id}"  => "ItensPedidosController@viewEditarItemPedido",
                "/itensPedidos/excluir/{id}" => "ItensPedidosController@viewExcluirItemPedido",
                "/itensPedidos/listar/{id}"  => "ItensPedidosController@viewListarItensPedido",

                // --------------------------
                // Funcionarios
                // --------------------------
                "/funcionarios"         => "FuncionariosController@viewListarFuncionarios",
                "/funcionarios/criar"   => "FuncionariosController@viewCriarFuncionarios",
                "/funcionarios/editar/{id}"  => "FuncionariosController@viewEditarFuncionarios",
                "/funcionarios/excluir/{id}" => "FuncionariosController@viewExcluirFuncionarios",
                "/funcionarios/listar/{id}"  => "FuncionariosController@viewListarFuncionarios",

                // --------------------------
                // Endereco
                // --------------------------
                "/endereco"             => "EnderecoController@viewListarEndereco",
                "/endereco/criar"       => "EnderecoController@viewCriarEndereco",
                "/endereco/editar/{id}"      => "EnderecoController@viewEditarEndereco",
                "/endereco/excluir/{id}"     => "EnderecoController@viewExcluirEndereco",
                "/endereco/listar/{id}"      => "EnderecoController@viewListarEndereco",

                // --------------------------
                // Categoria
                // --------------------------
                "/categoria"            => "CategoriaController@viewListarCategoria",
                "/categoria/criar"      => "CategoriaController@viewCriarCategoria",
                "/categoria/editar/{id}"     => "CategoriaController@viewEditarCategoria",
                "/categoria/excluir/{id}"    => "CategoriaController@viewExcluirCategoria",
                "/categoria/listar/{id}"     => "CategoriaController@viewListarCategoria",

                // --------------------------
                // Cargo (dominio)
                // --------------------------
                "/cargo"                => "CargoController@viewListarCargo",
                "/cargo/criar"          => "CargoController@viewCriarCargo",
                "/cargo/editar/{id}"         => "CargoController@viewEditarCargo",
                "/cargo/excluir/{id}"        => "CargoController@viewExcluirCargo",
                "/cargo/listar/{id}"         => "CargoController@viewListarCargo",

                // --------------------------
                // Agendamento
                // --------------------------
                "/agendamento"          => "AgendamentoController@viewListarAgendamento",
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
                "/promocoes/salvar"     => "PromocoesController@salvarPromocoes",
                "/promocoes/atualizar"  => "PromocoesController@atualizarPromocoes",
                "/promocoes/deletar"    => "PromocoesController@deletarPromocoes",

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
                "/funcionarios/salvar"  => "FuncionariosController@salvarFuncionarios",
                "/funcionarios/atualizar" => "FuncionariosController@atualizarFuncionarios",
                "/funcionarios/deletar" => "FuncionariosController@deletarFuncionarios",

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
