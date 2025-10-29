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
                "/usuario/index"         => "UsuarioController@index",
                "/usuario/criar"         => "UsuarioController@viewCriarUsuario",
                "/usuario/editar/{id}"        => "UsuarioController@viewEditarUsuario",
                "/usuario/excluir/{id}"       => "UsuarioController@viewExcluirUsuario",
                "/usuario/listar/{id}"        => "UsuarioController@viewListarUsuario",

                // --------------------------
                // Tipo Usuario (dominio)
                // --------------------------

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
                "/pedidos/busca/{id}"    => "PedidosController@Items",


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

                // --------------------------
                // Admin Dashboard
                // --------------------------
                '/admin/dashboard' => 'Admin\DashboardController@index',

                // --------------------------
                // Autenticação
                // --------------------------
                '/register' => 'AuthController@register',                
                '/login' => 'AuthController@login',
                '/logout' => 'AuthController@logout',

            ],

            'POST' => [

                // Usuarios
                "/usuario/salvar/"       => "UsuarioController@salvarUsuario",
                "/usuario/atualizar"    => "UsuarioController@atualizarUsuario",
                "/usuario/deletar"      => "UsuarioController@deletarUsuario",


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

                //autenticação
                '/register' => 'AuthController@cadastrarUsuario',
                '/login' => 'AuthController@authenticar',

                //alterar a senha
                '/esqueci-senha' => 'AuthController@enviarLinkDoEmail',
                '/reseta-senha' => 'AuthController@resetaSenha',
            ]
        ];
    }
}
