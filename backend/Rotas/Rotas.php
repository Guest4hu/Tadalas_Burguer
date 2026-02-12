<?php

namespace App\Tadala\Rotas;

class Rotas
{
    public static function get()
    {
        return [
            'GET' => [

                 
                // --------------------------
                // Api Desktop
                // --------------------------
 
 
                '/desktop/api/categorias' => 'API\Desktop\ApiDesktopCategoriaController@Items',
                '/desktop/api/produtos' => 'API\Desktop\ApiDesktopProdutoController@Items',
                '/desktop/api/usuarios' => 'API\Desktop\ApiDesktopUsuarioController@Items',
                '/desktop/api/enderecos' => 'API\Desktop\ApiDesktopEnderecoController@Items',
                '/desktop/api/pedidos' => 'API\Desktop\ApiDesktopPedidoController@Items',
                '/desktop/api/itensPedidos' => 'API\Desktop\ApiDesktopItensPedidoController@Items',
                '/desktop/api/pagamentos' => 'API\Desktop\ApiDesktopPagamentoController@Items',
                '/desktop/api/dominioTipoUsuario' => 'API\Desktop\ApiDesktopDominioController@dominioTipoUsuario',
                '/desktop/api/dominioTipoPedido' => 'API\Desktop\ApiDesktopDominioController@dominioTipoPedido',
                '/desktop/api/dominioStatusPagamento' => 'API\Desktop\ApiDesktopDominioController@dominioStatusPagamento',
                '/desktop/api/dominioMetodoPagamento' => 'API\Desktop\ApiDesktopDominioController@dominioMetodoPagamento',
                '/desktop/api/dominioStatusPedido' => 'API\Desktop\ApiDesktopDominioController@dominioStatusPedido',
 


                "/cliente"              =>  "UsuarioController@viewListarUsuario",
                "/cliente/index"        =>  "UsuarioController@index",
                "/cliente/criar"        =>  "UsuarioController@viewCriarUsuario",
                "/cliente/editar/{id}"  =>  "UsuarioController@viewEditarUsuario",
                "/cliente/excluir/{id}" =>  "UsuarioController@viewExcluirUsuario",
                "/cliente/listar/{id}"  =>  "UsuarioController@viewListarUsuario",


                // --------------------------
                // Analises
                // --------------------------

                "/analises/pedidos"     => "AnalisesController@viewPedidos",
                "/analises/produtos"    => "AnalisesController@viewProdutos",
                "/analises/vendas"      => "AnalisesController@viewVendas",


                // --------------------------
                //Configuração
                // --------------------------

                "configuracao"        =>   "ConfiguracaoController@index",


                // --------------------------
                // Status Pedido (dominio)
                // --------------------------
                
                "configuracao/statusPedido"          => "StatusPedidoController@viewListarStatusPedido",
                "configuracao/statusPedido/criar"    => "StatusPedidoController@viewCriarStatusPedido",
                "configuracao/statusPedido/editar/{id}"   => "StatusPedidoController@viewEditarStatusPedido",
                "configuracao/statusPedido/excluir/{id}"  => "StatusPedidoController@viewExcluirStatusPedido",
                "configuracao/statusPedido/listar/{id}"   => "StatusPedidoController@viewListarStatusPedido",


                // --------------------------
                // Tipo Pedido (dominio)
                // --------------------------
                
                "configuracao/tipoPedido"          => "TipoPedidoController@viewListarTipoPedido",
                "configuracao/tipoPedido/criar"    => "TipoPedidoController@viewCriarTipoPedido",
                "configuracao/tipoPedido/editar/{id}"   => "TipoPedidoController@viewEditarTipoPedido",
                "configuracao/tipoPedido/excluir/{id}"  => "TipoPedidoController@viewExcluirTipoPedido",
                "configuracao/tipoPedido/listar/{id}"   => "TipoPedidoController@viewListarTipoPedido",


                // --------------------------
                // Status Pagamento (dominio)
                // --------------------------
                
                "configuracao/statusPagamento"       => "StatusPagamentoController@viewListarStatusPagamento",
                "configuracao/statusPagamento/criar"  => "StatusPagamentoController@viewCriarStatusPagamento",
                "configuracao/statusPagamento/editar/{id}" => "StatusPagamentoController@viewEditarStatusPagamento",
                "configuracao/statusPagamento/excluir/{id}" => "StatusPagamentoController@viewExcluirStatusPagamento",
                "configuracao/statusPagamento/listar/{id}" => "StatusPagamentoController@viewListarStatusPagamento",


                // --------------------------
                // Status Funcionario (dominio)
                // --------------------------
                
                "configuracao/statusFuncionario"         => "StatusFuncionarioController@viewListarStatusFuncionario",
                "configuracao/statusFuncionario/criar"    => "StatusFuncionarioController@viewCriarStatusFuncionario",
                "configuracao/statusFuncionario/editar/{id}"   => "StatusFuncionarioController@viewEditarStatusFuncionario",
                "configuracao/statusFuncionario/excluir/{id}"  => "StatusFuncionarioController@viewExcluirStatusFuncionario",
                "configuracao/statusFuncionario/listar/{id}"   => "StatusFuncionarioController@viewListarStatusFuncionario",


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
                "/produtos/criar"       => "ProdutosController@viewCriarProdutos",
                "/produtos/editar/{id}"      => "ProdutosController@viewEditarProdutos",
                "/produtos/excluir/{id}"     => "ProdutosController@viewExcluirProdutos",
                "/produtos/listar/{pagina}"      => "ProdutosController@viewListarProdutos",


                // --------------------------
                // Pedidos
                // --------------------------
                
                "/pedidos"              => "PedidosController@index",
                "/pedidos/criar"        => "PedidosController@viewCriarPedidos",
                "/pedidos/editar/{id}"       => "PedidosController@viewEditarPedidos",
                "/pedidos/excluir/{id}"      => "PedidosController@viewExcluirPedidos",
                "/pedidos/listar/{pagina}"       => "PedidosController@viewListarPedidos",
                "/pedidos/api/busca/{id}"    => "API\APIPedidoController@Items",
                '/pedidos/api/buscarTipoPedidos' => 'API\APIPedidoController@viewbuscarTipoPedidos',
                '/pedidos/api/quantidades/{tipo}' => 'API\APIPedidoController@contarPedidosPorTipo',
                '/pedidos/api/notificacoes/1' => 'API\APIPedidoController@ContarNotificacoes',
                '/pedidos/api/buscaEndereco/{usuarioId}' => 'API\APIPedidoController@buscaEndereco',
                '/pedidos/api/calculaValorTotal/{pedidoID}' => 'API\APIPedidoController@calculaValorTotal',
                '/pedidos/api/buscarProdutos'  => 'API\APIPedidoController@buscarProdutos',

                // --------------------------
                // Funcionarios
                // --------------------------
                
                "/funcionarios/{pagina}"         => "FuncionariosController@viewListarFuncionarios",
                "/funcionarios/criar"   => "FuncionariosController@viewCriarFuncionarios",
                "/funcionarios/editar/{id}"  => "FuncionariosController@viewEditarFuncionarios",
                "/funcionarios/excluir/{id}" => "FuncionariosController@viewExcluirFuncionarios",
                "/funcionarios/listar/{id}"  => "FuncionariosController@viewListarFuncionarios",


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
                // PUBLIC APIs
                // --------------------------

                '/api/produtos' => 'PublicApiController@getProdutos',
                '/api/produtos/categoria/{categoriaID}' => 'PublicApiController@getProdutosPorCategoria',
                '/api/categorias' => 'PublicApiController@getCategorias',

                // --------------------------
                // Auth (mock)
                // --------------------------

                '/login' => 'AuthController@viewLogin',
                '/register' => 'AuthController@viewRegister',
                '/logout' => 'AuthController@logout',
                '/me' => 'AuthController@me',
            
            ],

            'POST' => [

                // Usuarios
                "/usuario/salvar"       => "UsuarioController@salvarUsuario",
                "/usuario/atualizar/{id}" => "UsuarioController@atualizarUsuario",
                "/usuario/deletar"      => "UsuarioController@deletarUsuario",

                // StatusPedido
                "configuracao/statusPedido/salvar"  => "StatusPedidoController@salvarStatusPedido",
                "configuracao/statusPedido/atualizar" => "StatusPedidoController@atualizarStatusPedido",
                "configuracao/statusPedido/deletar" => "StatusPedidoController@deletarStatusPedido",

                //Tipo de Pedidos
                "configuracao/tipoPedido/salvar"  => "TipoPedidoController@salvarTipoPedido",
                "configuracao/tipoPedido/atualizar" => "TipoPedidoController@atualizarTipoPedido",
                "configuracao/tipoPedido/deletar" => "TipoPedidoController@deletarTipoPedido",

                // StatusPagamento
                "configuracao/statusPagamento/salvar"  => "StatusPagamentoController@salvarStatusPagamento",
                "configuracao/statusPagamento/atualizar" => "StatusPagamentoController@atualizarStatusPagamento",
                "configuracao/statusPagamento/deletar" => "StatusPagamentoController@deletarStatusPagamento",

                // StatusFuncionario
                "configuracao/statusFuncionario/salvar"  => "StatusFuncionarioController@salvarStatusFuncionario",
                "configuracao/statusFuncionario/atualizar" => "StatusFuncionarioController@atualizarStatusFuncionario",
                "configuracao/statusFuncionario/deletar" => "StatusFuncionarioController@deletarStatusFuncionario",

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
                "/pedidos/teste"        => "PedidosController@testeSalvarPedido",
                "/pedidos/atualizarProcesso"    => "PedidosController@AtualizarPedido",
                "/pedidos/deletar"      => "PedidosController@deletarPedidos",
                '/pedidos/busca/{id}' => 'PedidosController@buscarPedido',
                '/pedidos/adicionarItensPedido' => "PedidosController@adicionarPedidos",
                '/pedidos/atualizarItensPedidoQTD' => "PedidosController@atualizarItensPedidoQTD",
                '/pedidos/deletarItem' => "PedidosController@deletarItemPedidos",
                
                // Funcionarios
                "/funcionarios/salvar"  => "FuncionariosController@salvarFuncionarios",
                "/funcionarios/atualizar" => "FuncionariosController@atualizarFuncionarios",
                "/funcionarios/deletar" => "FuncionariosController@deletarFuncionarios",

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
