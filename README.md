# 🍔 Tadalas Burguer - Digital Ecosystem

Bem-vindo ao ecossistema digital do **Tadalas Burguer**. Este projeto consiste em uma solução completa para hamburguerias, integrando um site institucional para clientes e um sistema administrativo (ERP/PDV) robusto para gestão interna.

---

## 📑 Sumário

- [Visão Geral](#-visão-geral)
- [Arquitetura do Projeto](#-arquitetura-do-projeto)
- [Principais Funcionalidades](#-principais-funcionalidades)
- [Tecnologias Utilizadas](#-tecnologias-utilizadas)
- [Estrutura de Pastas](#-estrutura-de-pastas)
- [Configuração e Instalação](#-configuração-e-instalação)
- [Autores](#-autores)

---

## 🚀 Visão Geral

O **Tadalas Burguer** foi desenvolvido para transformar a operação analógica em um fluxo digital eficiente. 
1. **Lado do Cliente:** Site intuitivo para visualização de cardápio e realização de pedidos via WhatsApp.
2. **Lado Administrativo:** Painel completo para gestão de pedidos em tempo real, controle de estoque, finanças e análise de dados.

---

## 🏗 Arquitetura do Projeto

O sistema utiliza uma arquitetura **MVC (Model-View-Controller)** customizada em PHP, garantindo separação de responsabilidades e facilidade de manutenção.

- **Models:** Gerenciam a lógica de dados e as interações com o banco de dados (MySQL).
- **Views:** Templates PHP dinâmicos estilizados com CSS moderno e componentes interativos.
- **Controllers:** Orquestram as requisições, validam dados e conectam os Models às Views.
- **Core:** Classes base para roteamento, gerenciamento de sessões, upload de arquivos e notificações.

---

## ✨ Principais Funcionalidades

### 🖥 Sistema Administrativo (Backend)
- **Painel de Pedidos (PDV):** Gestão de pedidos organizada por status (Novo, Em Preparo, Em Entrega, Concluído).
- **Gestão de Cardápio:** Cadastro de produtos com fotos, categorias e controle de promoções.
- **Controle de Estoque:** Monitoramento de insumos e alerta de baixo estoque.
- **Análises & BI:** Dashboard com gráficos de faturamento mensal, volume de pedidos e ticket médio.
- **Gestão de Gastos:** Registro de despesas operacionais para cálculo de lucro real.
- **Recursos Humanos:** Gerenciamento de funcionários, cargos e permissões de acesso.

### 🌐 Site Institucional
- **Cardápio Digital:** Interface responsiva e otimizada para dispositivos móveis.
- **Carrinho Dinâmico:** Fluxo de compra fluido com integração direta ao WhatsApp da loja.
- **Status da Loja:** Indicador em tempo real de loja aberta/fechada.

---

## 🛠 Tecnologias Utilizadas

- **Backend:** PHP 8.1+, Composer.
- **Banco de Dados:** MySQL / SQLite.
- **Frontend:** HTML5, CSS3, JavaScript (ES6+).
- **Bibliotecas:** 
  - [Chart.js](https://www.chartjs.org/) (Gráficos e Análises).
  - [SweetAlert2](https://sweetalert2.github.io/) (Alertas e Modais).
  - [FontAwesome 6](https://fontawesome.com/) (Ícones).
  - [Google Fonts](https://fonts.google.com/) (Tipografia).

---

## 📂 Estrutura de Pastas

```text
Tadalas_Burguer/
├── assets/             # Recursos estáticos (imagens, CSS, JS do site)
├── backend/            # Núcleo do Sistema Administrativo
│   ├── Controllers/    # Lógica de controle
│   ├── Core/           # Classes base do Framework customizado
│   ├── Database/       # Configuração e conexão com banco de dados
│   ├── Models/         # Lógica de dados
│   ├── Rotas/          # Gerenciamento de rotas
│   └── Views/          # Templates e arquivos públicos do Admin
├── vendor/             # Dependências do Composer
├── index.php           # Landing Page / Home do Cliente
├── cardapio.php        # Visualização do Cardápio
├── carrinho.php        # Finalização de Pedidos
├── composer.json       # Configurações do Composer
└── .htaccess           # Configurações do servidor Apache
```

---

## ⚙ Configuração e Instalação

1. **Requisitos:** Servidor Apache com PHP 8.1+ e MySQL.
2. **Instalação:**
   - Clone o repositório.
   - Execute `composer install` para instalar as dependências.
   - Configure as credenciais do banco de dados em `backend/Database/Config.php`.
   - Importe o esquema SQL (verifique arquivos de migração ou utilize o `setup_gastos.php` para a tabela de despesas).
3. **Servidor Local:**
   - Você pode usar o servidor embutido do PHP: `php -S localhost:8000`.

---

## ✒ Autores

*   **Desenvolvimento:** [Seu Nome / Sua Empresa]
*   **Design:** Customizado para Tadalas Burguer.

---
*Este documento é parte integrante do projeto Tadalas Burguer e serve como guia técnico oficial.*
