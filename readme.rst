
## Descrição

Este é um projeto de controle de produtores e produção rural, desenvolvido em CodeIgniter 3.0.6. O objetivo principal deste projeto é fornecer uma solução simples e acessível para o gerenciamento de informações relacionadas à agricultura e produtores rurais.

**Nota:** Este projeto é um projeto antigo, e a interface pode parecer um pouco datada. No entanto, foi projetado com a simplicidade e a facilidade de compreensão em mente, tornando-o adequado para iniciantes e para fins de estudo.

## Funcionalidades

- Cadastro de Produtores Rurais
- Registro de Propriedades e Cultivos
- Controle de Colheitas e Produção
- Relatórios de Produção e Desempenho

## Estrutura do Banco de Dados

O projeto foi inicialmente projetado para usar o MySQL como banco de dados, mas pode ser adaptado para outros sistemas de gerenciamento de banco de dados, se necessário. A estrutura do banco de dados foi projetada com as seguintes tabelas principais:

- `grupousuario`: Armazena informações sobre grupos de usuários, como nome e descrição.

- `menu`: Registra detalhes sobre itens de menu, incluindo nome, categoria e descrição.

- `autorizacao`: Controla a autorização de grupos de usuários para acessar menus específicos.

- `municipio`: Armazena informações sobre municípios, incluindo nome e UF.

- `empresa`: Contém detalhes sobre empresas, como razão social, CNPJ e informações de contato.

- `tecnico`: Registra informações sobre técnicos de empresas, incluindo nome e função.

- `usuario`: Armazena informações de usuários, como nome, grupo, e-mail e informações de login.

- `tipo_imovel`: Contém tipos de imóveis.

- `grupo_especie`: Registra grupos de espécies.

- `especie_semovente`: Armazena informações sobre espécies semoventes.

- `especie_imovel`, `especie_movel`: Registram espécies relacionadas a imóveis e bens móveis.

- `finalidade_semovente`: Contém informações sobre finalidades de espécies semoventes.

- `raca`: Registra raças de espécies.

- `situacao_propriedade`, `estado_conservacao`, `gravame`: Tabelas de referência para várias situações.

- `tipo_cultivo`, `benfeitoria`, `agencia`, `produtos_agricola`, `atividade_pecuaria`: Tabelas de referência para tipos, atividades e recursos.

- `cliente`: Contém informações sobre clientes, incluindo detalhes de contato.

- `imoveis`: Armazena dados sobre imóveis, como tipo, área e localização.

- `imovel_solo`, `imovel_proprietario`, `imovel_benfeitoria`, `imovel_explorado_agricola`, `imovel_explorado_pecuaria`: Tabelas relacionadas a imóveis.

- `exploracao_agricola`, `produtos_secundarios_exploracao_pecuaria`, `exploracao_pecuaria`: Tabelas relacionadas a atividades agrícolas e pecuárias.

- `semoventes`: Contém informações sobre espécies semoventes.

- `moveis`: Armazena informações sobre bens móveis.

- `operacoes`: Registra informações sobre operações financeiras.

- `acao`: Controla ações relacionadas a menus.

- `logusuario`: Registra logs de ações de usuários.


## Como Usar

1. Clone este repositório para o seu ambiente local:

https://github.com/danieldisner/prjAgros.git

2. Configure o ambiente CodeIgniter conforme necessário.

3. Importe a estrutura do banco de dados para o seu sistema de gerenciamento de banco de dados (MySQL, por padrão).

4. Configure as informações de conexão com o banco de dados no arquivo `application/config/database.php`.

5. Execute o projeto localmente e comece a usá-lo para gerenciar produtores e produção rural.

## Contribuição

Este projeto é de código aberto, e você é encorajado a contribuir para seu desenvolvimento e melhorias. Sinta-se à vontade para enviar problemas (issues) e pull requests com novos recursos, correções de bugs ou melhorias na interface.


###################
What is CodeIgniter
###################

CodeIgniter is an Application Development Framework - a toolkit - for people
who build web sites using PHP. Its goal is to enable you to develop projects
much faster than you could if you were writing code from scratch, by providing
a rich set of libraries for commonly needed tasks, as well as a simple
interface and logical structure to access these libraries. CodeIgniter lets
you creatively focus on your project by minimizing the amount of code needed
for a given task.

*******************
Release Information
*******************

This repo contains in-development code for future releases. To download the
latest stable release please visit the `CodeIgniter Downloads
<https://codeigniter.com/download>`_ page.

**************************
Changelog and New Features
**************************

You can find a list of all changes for each release in the `user
guide change log <https://github.com/bcit-ci/CodeIgniter/blob/develop/user_guide_src/source/changelog.rst>`_.

*******************
Server Requirements
*******************

PHP version 5.4 or newer is recommended.

It should work on 5.2.4 as well, but we strongly advise you NOT to run
such old versions of PHP, because of potential security and performance
issues, as well as missing features.

************
Installation
************

Please see the `installation section <https://codeigniter.com/user_guide/installation/index.html>`_
of the CodeIgniter User Guide.

*******
License
*******

Please see the `license
agreement <https://github.com/bcit-ci/CodeIgniter/blob/develop/user_guide_src/source/license.rst>`_.

*********
Resources
*********

-  `User Guide <https://codeigniter.com/docs>`_
-  `Language File Translations <https://github.com/bcit-ci/codeigniter3-translations>`_
-  `Community Forums <http://forum.codeigniter.com/>`_
-  `Community Wiki <https://github.com/bcit-ci/CodeIgniter/wiki>`_
-  `Community IRC <https://webchat.freenode.net/?channels=%23codeigniter>`_

Report security issues to our `Security Panel <mailto:security@codeigniter.com>`_
or via our `page on HackerOne <https://hackerone.com/codeigniter>`_, thank you.

***************
Acknowledgement
***************

The CodeIgniter team would like to thank EllisLab, all the
contributors to the CodeIgniter project and you, the CodeIgniter user.