create table grupousuario(
    id           integer not null,
    nome          varchar(255) not null,
    descricao     varchar(255) not null not null,
    nrotentativa  integer,
    constraint pk_grupousuario primary key(id),
    constraint unq_grupousuario_desc unique(descricao)
);

create table menu(
    nome          varchar(255) not null,
    categoria     varchar(255) not null,
    descricao     varchar(255) not null,
    ordem         integer not null,
    caption       varchar(255) not null,
    constraint menu_pk primary key(nome)
);

create table autorizacao(
    grupo      integer not null,
    menu       varchar(255) not null,
    constraint pk_autorizacao primary key(grupo, menu),
    constraint fk_autorizacao_grupo foreign key(grupo) references grupousuario(id),
    constraint fk_autorizacao_menu foreign key(menu) references menu(nome)
);

create table municipio(
    id   integer not null auto_increment,
    nome  varchar(255) not null,
    uf    varchar(2) not null,
    constraint pk_municipio primary key(id)
);

create table empresa(
    id               integer not null auto_increment,
    razaosocial      varchar(255) not null,
    nomefantasia     varchar(255),
    cnpj             varchar(14),
    cep              varchar(9),
    endereco         varchar(255),
    nroendereco      varchar(15),
    complemento      varchar(40),
    bairro           varchar(255),
    municipio        integer,
    fone1            varchar(80),
    fone2            varchar(80),
    nomeresponsavel  varchar(255),
    cpfresponsavel   varchar(11),
    rgresponsavel    varchar(11),
    datacadastro     timestamp,
    logo	     longblob,
    constraint pk_empresa primary key(id),
    constraint fk_empresa_municipio foreign key(municipio) references municipio(id)
);

create table tecnico(
    id   integer not null,
    empresa integer not null,
    nome  varchar(255) not null,
    funcao varchar(255),
    registro varchar(255),
    conselhoregional varchar(255),
    visto varchar(255),
    fone1 varchar(80),
    fone2 varchar(80),
    constraint pk_municipio primary key(id,empresa),
    constraint fk_tecnico_empresa foreign key(empresa) references empresa(id)
);

create table usuario(
    usuario            varchar(255) not null,
    senha              varchar(50) not null,
    nome               varchar(255) not null,
    grupo              integer not null,
    datacadastro       timestamp,
    bloqueado          tinyint(1),
    confirmado         tinyint(1),
    numerodatentativa  integer,
    email              varchar(255) not null,
    empresa            integer,
    tecnico            integer,
    token              varchar(50),
    constraint pk_usuario primary key(usuario),
    constraint fk_usuario_grupo foreign key(grupo) references grupousuario(id),
    constraint fk_usuario_empresa foreign key(empresa) references empresa(id),
    constraint fk_usuario_tenico foreign key(empresa,tecnico) references tecnico(empresa,id)
);

create table tipo_imovel(
    id   integer not null auto_increment,
    nome  varchar(255) not null,
    constraint pk_tipo_imovel primary key(id)
);

create table grupo_especie(
    id           integer not null,
    nome         varchar (255) not null,
    constraint pk_grupo_especie primary key(id),
    constraint unq_grupo_especie_nome unique(nome)
);

create table especie_semovente(
    id   integer not null auto_increment,
    nome  varchar(255) not null,
    grupo  integer,
    constraint pk_especie_semovente primary key(id),
    constraint fk_especie_semovente_grupo foreign key(grupo) references grupo_especie(id)
);

create table especie_imovel(
    id   integer not null auto_increment,
    nome  varchar(255) not null,
    constraint pk_especie_imovel primary key(id)
);

create table especie_movel(
    id   integer not null auto_increment,
    nome  varchar(255) not null,
    constraint pk_especie_movel primary key(id)
);

create table finalidade_semovente(
    id   integer not null auto_increment,
    nome  varchar(255) not null,
    constraint pk_finalidade_semovente primary key(id)
);

create table raca(
    id     integer not null auto_increment,
    nome   varchar(255) not null,
    grupo  integer,
    constraint pk_raca primary key(id),
    constraint fk_raca_grupo foreign key(grupo) references grupo_especie(id)
);

create table situacao_propriedade(
    id   integer not null auto_increment,
    nome  varchar(255) not null,
    constraint pk_raca primary key(id)
);

create table estado_conservacao(
    id   integer not null auto_increment,
    nome  varchar(255) not null,
    constraint pk_raca primary key(id)
);

create table gravame(
    id   integer not null auto_increment,
    nome  varchar(255) not null,
    constraint pk_gravame primary key(id)
);

create table tipo_cultivo(
    id   integer not null auto_increment,
    nome  varchar(255) not null,
    constraint pk_tipo_cultivo primary key(id)
);

create table benfeitoria(
    id   integer not null auto_increment,
    nome  varchar(255) not null,
    codigo varchar(50),
    unidade varchar(50),
    constraint pk_benfeitoria primary key(id)
);

create table agencia(
    id integer not null auto_increment,
    nome varchar(255) not null,
    prefixo varchar(40),
    constraint pk_agencia primary key(id)
);

create table produtos_agricola(
    id integer not null auto_increment,
    nome varchar(255) not null,
    unidade varchar(40),
    codigoatividade varchar(50),
    produtividadamax integer,
    produtividademin integer,
    constraint pk_produtos_agricola primary key(id)
);

create table atividade_pecuaria(
    id integer not null auto_increment,
    nome varchar(255) not null,
    codigo integer,
    atividade varchar(255),
    unidadefinanciamento varchar(255),
    produtoprincipal varchar(255),
    unidadeproducao varchar(40),
    faseexploracao varchar(50),
    sistemaexploracao varchar(50),
    unidadeprodutividade varchar(255),
    valormin decimal(14,4),
    valormax decimal(14,4),
    produto2 varchar(255),
    prod2 decimal(14,4),
    produto3 varchar(255),
    prod3 decimal(14,4),
    produto4 varchar(255),
    prod4 decimal(14,4),
    produto5 varchar(255),
    prod5 decimal(14,4),
    produto6 varchar(255),
    prod6 decimal(14,4),
    produto7 varchar(255),
    prod7 decimal(14,4),
    pesofinal1 integer,
    pesofinal2 integer,
    natalidade1 decimal(14,4),
    natalidade2 decimal(14,4),
    fasedias1 integer,
    fasedias2 integer,
    pesoincial1 integer,
    pesoinicial2 integer,
    pesofinal3 integer,
    pesofinal4 integer,
    ganhopeso1 integer,
    ganhopeso2 integer,
    ciclosano decimal(14,4),
    obs1 varchar(255),
    obs2 varchar(255),	
    constraint pk_atividade_pecuaria primary key(id)
);	

create table cliente(
    empresa          integer not null,
    cpfcnpj          varchar(14) not null,
    nome             varchar(255) not null,
    rg               varchar(45),
    cep              varchar(9),
    endereco         varchar(255),
    nroendereco      varchar(15),
    complemento      varchar(40),
    bairro           varchar(255),
    municipio        integer,
    fone1            varchar(80),
    fone2            varchar(80),
    email            varchar(255),
    nomeconjuge      varchar(255),
    rgconjuge        varchar(45),
    cpfconjuge       varchar(11),
    agencia          integer,
    conta            varchar(255),
    datacadastro     date not null,
    constraint pk_cliente primary key(empresa,cpfcnpj),
    constraint fk_cliente_empresa foreign key(empresa) references empresa(id),
    constraint fk_cliente_municipio foreign key(municipio) references municipio(id),
    constraint fk_cliente_agencia foreign key(agencia) references agencia(id)
);

create table imoveis(
    empresa integer not null,
    id integer not null,
    cpfcnpj varchar(14) not null,
    tipo integer not null,
    nome varchar(255),
    especie integer,
    matricula varchar(255),
    registro varchar(255),
    cep varchar(9),
    endereco text,
    nroendereco varchar(15),
    bairro varchar(255),
    municipio integer,
    part integer,
    sitpropriedade integer,
    estadoconservacao integer,
    gravame integer,
    -- IMÓVEIS RURAIS --
    ccir varchar(255),
    nirf varchar(255),
    latitude varchar(255),
    longitude varchar(255),
    cessaoterceiros tinyint(1),
    valorhectare decimal(14,4),
    areatotal decimal(14,4),
    valorterranua decimal(14,4),	
    -- IMÓVEIS URBANOS --
    areaterreno decimal(14,4),
    areaconstruida decimal(14,4),
    valortotal decimal(14,4),
    -- Exploração --
    exploradoagricola tinyint(1),
    exploradopecuaria tinyint(1),
    constraint pk_imoveis primary key(empresa,id,cpfcnpj,tipo),
    constraint fk_imoveis_empresa foreign key(empresa) references empresa(id),
    constraint fk_imoveis_cliente foreign key(empresa,cpfcnpj) references cliente(empresa,cpfcnpj),
    constraint fk_imoveis_tipo foreign key(tipo) references tipo_imovel(id),
    constraint fk_imoveis_especie foreign key(especie) references especie_imovel(id),
    constraint fk_imoveis_municipio foreign key(municipio) references municipio(id),
    constraint fk_imoveis_sitpropriedade foreign key(sitpropriedade) references situacao_propriedade(id),
    constraint fk_imoveis_estadoconservacao foreign key(estadoconservacao) references estado_conservacao(id),
    constraint fk_imoveis_gravame foreign key(gravame) references gravame(id)	
);

create table imovel_solo(
    empresa integer not null,
    imovel integer not null,
    cpfcnpj varchar(14) not null,
    tipo varchar(255) not null,
    area decimal(14,4),
    constraint pk_imovel_solo primary key(empresa,imovel,cpfcnpj,tipo),
    constraint fk_imovel_solo_empresa foreign key(empresa) references empresa(id),
    constraint fk_imovel_solo_cliente foreign key(empresa,cpfcnpj) references cliente(empresa,cpfcnpj)
);

create table imovel_proprietario(
    empresa integer not null,
    imovel integer not null,
    cpfcnpj varchar(14) not null,
    cpfcnpjproprietario varchar(14) not null,
    nome varchar(255) not null,
    part integer,
    constraint pk_imovel_proprietarios primary key(empresa,imovel,cpfcnpj,cpfcnpjproprietario),
    constraint fk_imovel_proprietarios_empresa foreign key(empresa) references empresa(id),
    constraint fk_imovel_proprietarios_cliente foreign key(empresa,cpfcnpj) references cliente(empresa,cpfcnpj)
);

create table imovel_benfeitoria(
    empresa integer not null,
    imovel integer not null,
    cpfcnpj varchar(14) not null,
    benfeitoria integer not null,
    dimensao decimal(14,4),
    idade integer,
    valor decimal(14,4),
    constraint pk_imovel_benfeitoria primary key(empresa,imovel,cpfcnpj,benfeitoria),
    constraint fk_imovel_benfeitoria_empresa foreign key(empresa) references empresa(id),
    constraint fk_imovel_benfeitoria_cliente foreign key(empresa,cpfcnpj) references cliente(empresa,cpfcnpj),
    constraint fk_imovel_benfeitoria_benfeitoria foreign key(benfeitoria) references benfeitoria(id)
);


create table exploracao_agricola(
    empresa integer not null,
    id integer not null,
    cpfcnpj varchar(14) not null,
    municipio integer,
    atividade integer,
    sistemaproducaoobtida varchar(50),
    sistemaproducaoprevista varchar(50),
    tipocultivo integer,
    irrigacao tinyint(1),
    datainiciocolheitaobtida date,
    datafimcolheitaobtida date,
    datainiciocolheitaprevista date,
    datafimcolheitaprevista date,
    datainiciocomercializacaoobtida date,
    datafimcomercializacaoobtida date,
    datainiciocomercializacaoprevista date,
    datafimcomercializacaoprevista date,
    datainicioproducaoobtida date,
    datafimproducaoobtida date,
    datainicioproducaoprevista date,
    datafimproducaoprevista date,
    anosafrainicioobtida integer,
    anosafrafimobtida integer,
    anosafrainicioprevista integer,
    anosafrafimprevista integer,
    participacaoobtida integer,
    participacaoprevista integer,
    areaobtida decimal(14,4),
    areaprevista decimal(14,4),
    precounitarioobtida decimal(14,4),
    precounitarioprevista decimal(14,4),
    produtividadeprevistaobtida decimal(14,4),
    produtividadeprevistaprevista decimal(14,4),
    produtividadeobtidaobtida decimal(14,4),
    frustracaosafraobtida tinyint(1),
    receitabrutaobtida decimal(14,4),
    receitabrutaprevista decimal(14,4),
    custoproducaohectareobtida decimal(14,4),
    custoproducaohectareprevista decimal(14,4),
    custoproducaototalobtida decimal(14,4),
    custoproducaototalprevista decimal(14,4),
    custototalcomarrendamentoobtida decimal(14,4),
    custototalcomarrendamentoprevista decimal(14,4),
    tratoresimplementosterceirosobtida decimal(14,4),
    tratoresimplementosterceirosprevista decimal(14,4),
    colheitadeirasterceirosobtida decimal(14,4),
    colheitadeirasterceirosprevista decimal(14,4),
    receitaunidadeproducaoobtida decimal(14,4),
    receitaunidadeproducaoprevista decimal(14,4),
    receitaliquidaobtida decimal(14,4),
    receitaliquidaprevista decimal(14,4),
    constraint pk_exploracao_agricola primary key(empresa,id,cpfcnpj),
    constraint fk_exploracao_agricola_empresa foreign key(empresa) references empresa(id),
    constraint fk_exploracao_agricola_cliente foreign key(empresa,cpfcnpj) references cliente(empresa,cpfcnpj),
    constraint fk_exploracao_agricola_municipio foreign key(municipio) references municipio(id),
    constraint fk_exploracao_agricola_produtos_agricola foreign key(atividade) references produtos_agricola(id),
    constraint fk_exploracao_agricola_tipo_cultivo foreign key(tipocultivo) references tipo_cultivo(id)
);

create table imovel_explorado_agricola(
    empresa integer not null,
    imovel integer not null,
    cpfcnpj varchar(14) not null,
    exploracaoagricola integer not null,
    areaexploradaobtida decimal(14,4),
    areaexploradaprevista decimal(14,4),
    constraint pk_imovel_explorado_agricola primary key(empresa,imovel,exploracaoagricola,cpfcnpj),
    constraint fk_imovel_explorado_agricola_empresa foreign key(empresa) references empresa(id),
    constraint fk_imovel_explorado_agricola_cliente foreign key(empresa,cpfcnpj) references cliente(empresa,cpfcnpj),
    constraint fk_imovel_explorado_agricola_exploracao foreign key(empresa,exploracaoagricola,cpfcnpj) references exploracao_agricola(empresa,id,cpfcnpj)
);

create table exploracao_pecuaria(
    empresa integer not null,
    id integer not null,
    cpfcnpj varchar(14) not null,
    municipio integer,
    atividade integer,
    sistemaproducaoobtida varchar(50),
    sistemaproducaoprevista varchar(50),
    produtividadeobtida decimal(14,4),
    produtividadeprevista decimal(14,4),
    datainicioproducaoobtida date,
    datafimproducaoobtida date,
    datainicioproducaoprevista date,
    datafimproducaoprevista date,
    participacaoobtida integer,
    participacaoprevista integer,
    quantidadeobtida decimal(14,4),
    quantidadeprevista decimal(14,4),
    quantidadeciclosanoobtida decimal(14,4),
    quantidadeciclosanoprevista decimal(14,4),
    precoobtida decimal(14,4),
    precoprevista decimal(14,4),
    producaototalobtida decimal(14,4),
    producaototalprevista decimal(14,4),
    producaounidadefinanciamentoobtida decimal(14,4),
    producaounidadefinanciamentoprevista decimal(14,4),
    custoproducaoobtida decimal(14,4),
    custoproducaoprevista decimal(14,4),
    custoproducaounidadeobtida decimal(14,4),
    custoproducaounidadeprevista decimal(14,4),
    receitacomvendaobtida decimal(14,4),
    receitacomvendaprevista decimal(14,4),
    receitatotalobtida decimal(14,4),
    receitatotalprevista decimal(14,4),
    receitatotalunidadefinanciamentoobtida decimal(14,4),
    receitatotalunidadefinanciamentoprevista decimal(14,4),
    custototalcomarrendamentoobtida decimal(14,4),
    custototalcomarrendamentoprevista decimal(14,4),
    receitaliquidaanoobtida decimal(14,4),
    receitaliquidaanoprevista decimal(14,4),
    tratoresimplementosterceirosobtida decimal(14,4),
    tratoresimplementosterceirosprevista decimal(14,4),
    constraint pk_exploracao_pecuaria primary key(empresa,id,cpfcnpj),
    constraint fk_exploracao_pecuaria_empresa foreign key(empresa) references empresa(id),
    constraint fk_exploracao_pecuaria_cliente foreign key(empresa,cpfcnpj) references cliente(empresa,cpfcnpj),
    constraint fk_exploracao_pecuaria_municipio foreign key(municipio) references municipio(id),
    constraint fk_exploracao_pecuaria_atividade_pecuaria foreign key(atividade) references atividade_pecuaria(id)
);

create table produtos_secundarios_exploracao_pecuaria(
    empresa integer not null,
    id integer not null,
    cpfcnpj varchar(14) not null,
    exploracaopecuaria integer not null,
    vendasobtida decimal(14,4),
    vendasprevista decimal(14,4),
    constraint pk_prod_secundarios_exploracao_pecuaria primary key(empresa,id,exploracaopecuaria,cpfcnpj),
    constraint fk_prod_secundarios_exploracao_pecuaria_empresa foreign key(empresa) references empresa(id),
    constraint fk_prod_secundarios_exploracao_pecuaria_cliente foreign key(empresa,cpfcnpj) references cliente(empresa,cpfcnpj),
    constraint fk_prod_secundarios_exploracao_pecuaria_exploracao foreign key(empresa,exploracaopecuaria,cpfcnpj) references exploracao_pecuaria(empresa,id,cpfcnpj)
);

create table imovel_explorado_pecuaria(
    empresa integer not null,
    imovel integer not null,
    cpfcnpj varchar(14) not null,
    exploracaopecuaria integer not null,
    areaexploradaobtida decimal(14,4),
    areaexploradaprevista decimal(14,4),
    constraint pk_imovel_explorado_pecuaria primary key(empresa,imovel,exploracaopecuaria,cpfcnpj),
    constraint fk_imovel_explorado_pecuaria_empresa foreign key(empresa) references empresa(id),
    constraint fk_imovel_explorado_pecuaria_cliente foreign key(empresa,cpfcnpj) references cliente(empresa,cpfcnpj),
    constraint fk_imovel_explorado_pecuaria_exploracao foreign key(empresa,exploracaopecuaria,cpfcnpj) references exploracao_pecuaria(empresa,id,cpfcnpj)
);

create table semoventes(
    empresa integer not null,
    id integer not null,
    cpfcnpj varchar(14) not null,
    especie integer,
    quantidade integer,
    finalidade integer,
    raca integer,
    pelagem varchar(50),
    graumesticagem varchar(40),
    idade integer,
    gravame integer,
    seguro tinyint(1),
    sitpropriedade integer,
    valorunitario decimal(14,4),
    valortotal decimal(14,4),
    part integer,
    imovel integer,
    tipoimovel integer,
    constraint pk_semoventes primary key(empresa,id,cpfcnpj),
    constraint fk_semoventes_empresa foreign key(empresa) references empresa(id),
    constraint fk_semoventes_cliente foreign key(empresa,cpfcnpj) references cliente(empresa,cpfcnpj),
    constraint fk_semoventes_especie foreign key(especie) references especie_semovente(id),
    constraint fk_semoventes_finalidade foreign key(finalidade) references finalidade_semovente(id),
    constraint fk_semoventes_raca foreign key(raca) references raca(id),
    constraint fk_semoventes_gravame foreign key(gravame) references gravame(id),
    constraint fk_semoventes_sitpropriedade foreign key(sitpropriedade) references situacao_propriedade(id)
);

create table moveis(
    empresa integer not null,
    id integer not null,
    cpfcnpj varchar(14) not null,
    especie integer,
    fabricante varchar(255),
    modelo varchar(255),
    anomodelo integer,
    sitpropriedade integer,
    gravame integer,
    seriechassi varchar(200),
    potencia integer,
    potenciatipo varchar(10),
    estadoconservacao integer,
    part integer,
    valor decimal(14,4),
    imovel integer,
    tipoimovel integer,
    constraint pk_moveis primary key(empresa,id,cpfcnpj),
    constraint fk_moveis_empresa foreign key(empresa) references empresa(id),
    constraint fk_moveis_cliente foreign key(empresa,cpfcnpj) references cliente(empresa,cpfcnpj),
    constraint fk_moveis_especie foreign key(especie) references especie_movel(id),
    constraint fk_moveis_sitpropriedade foreign key(sitpropriedade) references situacao_propriedade(id),
    constraint fk_moveis_gravame foreign key(gravame) references gravame(id),
    constraint fk_moveis_estadoconservacao foreign key(estadoconservacao) references estado_conservacao(id)
);

create table operacoes(
    empresa integer not null,
    cpfcnpj varchar(14) not null,
    tipooperacao varchar(10) not null,
    finalidade varchar(20) not null,
    ciclocanoinicio integer not null,
    ciclocanofim integer not null,
    status varchar(10),
    -- caso projeto --
    linhacreditoprojeto varchar(50),
    taxajurosprojeto decimal(14,4),
    datainicioprojeto date,
    dataconclusaoprojeto date,
    -- caso análise --
       aprovado tinyint(1),
    -- aprovado --
    linhacreditoanalise varchar(50),
    dataliberacaoanalise date,
    taxajurosanalise decimal(14,4),
    prazoanalise date,
    datareembolsoanalise date,
    -- negado --  
    dataconclusaoanalise date,
    constraint pk_operacoes primary key(empresa,cpfcnpj,tipooperacao,finalidade,ciclocanoinicio,ciclocanofim),
    constraint fk_operacoes_empresa foreign key(empresa) references empresa(id),
    constraint fk_operacoes_cliente foreign key(empresa,cpfcnpj) references cliente(empresa,cpfcnpj)
);

create table acao(
    id integer not null auto_increment,
    nome varchar(255) not null,
    menu varchar(255),
    constraint pk_acao primary key(id),
    constraint fk_acao_menu foreign key(menu) references menu(nome)
);

create table logusuario(
    empresa integer not null,
    usuario varchar(255) not null,
    acao integer not null,
    datahora timestamp not null,
    registro varchar(255) not null,
    constraint pk_logusuario primary key(empresa,usuario,acao,datahora),
    constraint fk_logusuario_empresa foreign key(empresa) references empresa(id),
    constraint fk_logusuario_usuario foreign key(usuario) references usuario(usuario),
    constraint fk_logusuario_acao foreign key(acao) references acao(id)
);
