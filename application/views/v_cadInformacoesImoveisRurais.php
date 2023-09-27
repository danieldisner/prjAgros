<div id='janelaPrincipal' title='Cadastro de Informações Imóveis' style='display: none'>
    <div class='form-dialog-ui' style='height: 100%'>
        <form id='frmCadInformacoesImoveisRurais' method='post'>
            <input type='hidden' id='idImovel' name='idImovel'/>
            <input type='hidden' id='dadosSolo' name='dadosSolo'/>
            <input type='hidden' id='dadosProprietario' name='dadosProprietario'/>
            <input type='hidden' id='dadosBenfeitoria' name='dadosBenfeitoria'/>
            <div class='form-group' style='height: 515px'>
                <div class='row'>
                    <div class='col-xs-1'>
                        <label for='btnProcCliente'></label>
                    </div>
                    <div id='rdGroupCpf' class='col-xs-10'>
                        <input type='radio' id='rdCPF' name='rdTipoCliente' checked='checked'/><label for='rdCPF'>CPF</label>
                        <input type='radio' id='rdCNPJ' name='rdTipoCliente'/><label for='rdCNPJ'>CNPJ</label>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-xs-1'>
                        <button id='btnProcCliente' name='btnProcCliente' class='form-control jqbutton'/><span class='glyphicon glyphicon-search'></span></button>
                    </div>
                    <div class='col-xs-3'>
                        <input type='text' class='form-control cpf' id='cpfcnpj' name='cpfcnpj' placeholder='CPF Cliente'/>
                    </div>
                    <div class='col-xs-8'>
                        <input type='text' class='form-control' id='nome' name='nome' placeholder='Nome Completo'/>
                    </div>
                </div>
                <div class='row' style='padding-left: 5px;padding-right: 5px'>
                    <div id='accordion'>
                        <h3 id='accordionImoveis'>Imóveis Rurais</h3>
                        <div id='divAccordionImoveis' class='groupAccordion'>
                            <div id='gridRurais'></div>
                        </div>
                    </div>
                    <div id='tabs'>
                        <ul>
                            <li><a href='#usoSolo'>Capacidade de Uso do Solo</a></li>
                            <li><a href='#proprietarios'>Outros Proprietarios</a></li>
                            <li><a href='#benfeitorias'>Benfeitorias</a></li>
                            <li><a id='aba1' href='#roteiroDeAcesso'>Roteiro de Acesso</a></li>
                        </ul>
                        <div id='usoSolo' style='height:100%;'>
                            <div class='form-group'>
                                <div class='row'>
                                    <div class='col-xs-5'>
                                        <label class='control-label'>Tipo</label>
                                        <select class='form-control' id='tipoUsoSolo' name='tipoUsoSolo'>
                                            <option value='Agricultura - Lavouras anuais'>Agricultura - Lavouras anuais</option>
                                            <option value='Agricultura - Lavouras perenes'>Agricultura - Lavouras perenes</option>
                                            <option value='Pastagem Cultivada'>Pastagem Cultivada</option>
                                            <option value='Pastagem Nativa'>Pastagem Nativa</option>
                                            <option value='Pastagem em Formação'>Pastagem em Formação</option>
                                            <option value='Silvicultura Florestas Comerciais'>Silvicultura Florestas Comerciais</option>
                                            <option value='Silvicultura Matas Nativas'>Silvicultura Matas Nativas</option>
                                            <option value='Reserva Legal e APP'>Reserva Legal e APP</option>
                                            <option value='Lagos, Lagoas'>Lagos, Lagoas</option>
                                            <option value='Construções e Benfeitorias'>Construções e Benfeitorias</option>
                                        </select>
                                    </div>
                                    <div class='col-xs-5'>
                                        <label class='control-label'>Área (ha)</label>
                                        <input type='text' class='form-control decimal' id='areaUsoSolo' name='areaUsoSolo' placeholder='Area'/>
                                    </div>
                                    <div class='col-xs-1' style='max-width: 60px;'>
                                        <label class='control-label'>&nbsp;</label>
                                        <button id='btnAddSolo' name='btnAddSolo' class='form-control jqbutton'/><span class='glyphicon glyphicon-plus'></span> </button>
                                    </div>
                                    <div class='col-xs-1' style='max-width: 60px;'>
                                        <label class='control-label'>&nbsp;</label>
                                        <button id='btnRemSolo' name='btnRemSolo' class='form-control jqbutton' disabled='disabled'/><span class='glyphicon glyphicon-minus'></span> </button>  
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-xs-12'>
                                    <div id='gridSolo'></div>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-xs-4'>
                                        <label class='control-label'>Área Total</label>
                                        <input type='text' class='form-control decimal' id='areatotal' name='areatotal' placeholder='AreaTotal' readonly='readonly'/>
                                    </div>
                                    <div class='col-xs-4'>
                                        <label class='control-label'>Valor por Hectare</label>
                                        <input type='text' class='form-control decimal' id='valorhectare' name='valorhectare' placeholder='Valor por Hectare'/>
                                    </div>
                                    <div class='col-xs-4'>
                                        <label class='control-label'>Valor Terra Nua</label>
                                        <input type='text' class='form-control decimal' id='valorterranua' name='valorterranua' placeholder='Valor Terra Nua' readonly='readonly'/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id='proprietarios' style='height:100%;'>
                            <div class='form-group'>
                                    <div class='row'>
                                    <div id='rdGroupCpfProprietario' class='col-xs-12'>
                                        <input type='radio' id='rdCPFProprietario' name='rdTipoProprietario' checked='checked'/><label for='rdCPFProprietario'>CPF</label>
                                        <input type='radio' id='rdCNPJProprietario' name='rdTipoProprietario'/><label for='rdCNPJProprietario'>CNPJ</label>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-xs-4'>
                                        <label class='control-label'>CPF/CNPJ</label>
                                        <input type='text' class='form-control cpf' id='cpfcnpjproprietario' name='cpfcnpjproprietario' placeholder='CPF/CNPJ'/>
                                    </div>
                                    <div class='col-xs-4'>
                                        <label class='control-label'>Nome</label>
                                        <input type='text' class='form-control' id='nomeproprietario' name='nomeproprietario' placeholder='Nome'/>
                                    </div>
                                    <div class='col-xs-1'>
                                        <label class='control-label'>%</label>
                                        <input type='text' class='form-control onlynumbers' id='partproprietario' name='partproprietario' placeholder='%'/>
                                    </div>
                                    <div class='col-xs-1' style='max-width: 60px;'>
                                        <label class='control-label'>&nbsp;</label>
                                        <button id='btnAddProprietario' name='btnAddProprietario' class='form-control jqbutton'/><span class='glyphicon glyphicon-plus'></span> </button>
                                    </div>
                                    <div class='col-xs-1' style='max-width: 60px;'>
                                        <label class='control-label'>&nbsp;</label>
                                        <button id='btnRemProprietario' name='btnRemProprietario' class='form-control jqbutton' disabled='disabled'/><span class='glyphicon glyphicon-minus'></span> </button>  
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-xs-12'>
                                    <div id='gridProprietario'></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id='benfeitorias' style='height: 100%'>
                            <div class='form-group'>
                                <div class='row'>
                                    <div class='col-xs-3'>
                                        <label class='control-label'>Tipo</label>
                                        <select class='form-control' id='tipoBenfeitoria' name='tipoBenfeitoria'>
                                            <?php foreach($tiposBenfeitoria as $tipoBenfeitoria){ ?>
                                                <option value='<?php echo $tipoBenfeitoria['id']?>'><?php echo $tipoBenfeitoria['nome']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class='col-xs-1'>
                                        <label class='control-label'>Dim.</label>
                                        <input type='text' class='form-control decimal' id='dimensaoBenfeitoria' name='dimensaoBenfeitoria' placeholder='Dimensões'/>
                                    </div>
                                        <div class='col-xs-1'>
                                        <label class='control-label'>Un.</label>
                                        <select class='form-control select-no-style' disabled='disabled' id='unidadeBenfeitoria' name='unidadeBenfeitoria'>
                                            <?php foreach($tiposBenfeitoria as $tipoBenfeitoria){ ?>
                                                <option value='<?php echo $tipoBenfeitoria['id']?>'><?php echo $tipoBenfeitoria['unidade']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class='col-xs-2'>
                                        <label class='control-label'>Idade</label>
                                        <input type='text' class='form-control onlynumbers' id='idadeBenfeitoria' name='idadeBenfeitoria' placeholder='Idade'/>
                                    </div>
                                    <div class='col-xs-2'>
                                        <label class='control-label'>Valor</label>
                                        <input type='text' class='form-control decimal' id='valorBenfeitoria' name='valorBenfeitoria' placeholder='Valor'/>
                                    </div>
                                    <div class='col-xs-1' style='max-width: 60px;'>
                                        <label class='control-label'>&nbsp;</label>
                                        <button id='btnAddBenfeitoria' name='btnAddBenfeitoria' class='form-control jqbutton'/><span class='glyphicon glyphicon-plus'></span> </button>
                                    </div>
                                    <div class='col-xs-1' style='max-width: 60px;'>
                                        <label class='control-label'>&nbsp;</label>
                                        <button id='btnRemBenfeitoria' name='btnRemBenfeitoria' class='form-control jqbutton' disabled='disabled'/><span class='glyphicon glyphicon-minus'></span> </button>  
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-xs-12'>
                                        <div id='gridBenfeitoria'></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id='roteiroDeAcesso' style='height: 100%'>
                            <label for='endereco'>Roteiro:</label>
                            <textarea class='form-control' rows='10' id='endereco' name='endereco'></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="groupBotoes">
                <input type='button' id='btnConfirmar' name='btnConfirmar' class='btn btn-lg btn-default' disabled='disabled' value='Confirmar'/>
                <input type='button' id='btnLimpar' name='btnLimpar' class='btn btn-lg btn-default' value='Limpar'/>
                <input type='button' id='btnFechar' name='btnFechar' class='btn btn-lg btn-default' value='Fechar'/>
            </div>
        </form>
    </div>
</div>
<div id='procuraCliente' title='Procura Cliente' style='display: none'>
    <input type='text' class='form-control required' id='nomeBusca' name='nomeBusca' placeholder='Nome Cliente'/>
    <div id='gridCliente'></div>
</div>
<script>
$(function(){
    var empresa = <?php echo $this->session->userdata('empresa'); ?>;
    // Janela Principal da Tela
    $('#janelaPrincipal').dialog({
        dialogClass: 'no-close',
        width: '70%',
        height: '650',
        modal: true
    });
    $('#cpfcnpj').focus();
    
    // Arruma o conflito nos botões do JQuery UI para estilizar os radio Buttons
    if($.fn.button.noConflict){
        $.fn.btn = $.fn.button.noConflict();
    };
    
    // Abas
    $('#tabs').tabs({
        heightStyle: 'content'
    });
    
    // Inicia o grupo dos radios com o JQueryUI
    $('#rdGroupCpf').buttonset();
    
    // Inicia o grupo dos radios com o JQueryUI
    $('#rdGroupCpfProprietario').buttonset();

    // Inicia os botões para a classe jqbutton
    $('.jqbutton').button();
    
    // Accordion
    $('#accordion,#accordion2').accordion({
        collapsible: true,
        heightStyle: 'content'
    });
    
    // Tela de Procura de Cliente
    $('#procuraCliente').dialog({
      dialogClass: 'no-close',
      resizable: false,
      modal: true,
      width: '620px',
      height: '320',
      autoOpen: false,
      buttons: {
        'Fechar': function(){
            $(this).dialog('close');
        }
      }
    });
    
    // Botão de Procura de Cliente
    $('#btnProcCliente').click(function(event){
        event.preventDefault();
        gridClienteLoad();
        $('#procuraCliente').dialog('open');
    });
    
    // Função responsável pelo carregamento da tela de procura de agência
    var $dgCliente = $('#gridCliente');
    function gridClienteLoad(){
        $dgCliente.datagrid({
            jsonStore: {
                url:' <?php echo base_url('CadCliente/dadosGridProcCliente?') ?>'  + 'nome=' + $('#nomeBusca').val()
            },
            height : 140,
            pagination: false,
            mapper:[
                {name: 'cpfcnpj',title:'CPF/CNPJ', width: '100px', align: 'left'},  
                {name: 'nome', title: 'Nome', width: '400px', align: 'left'},       
                {name: 'hidden', hidden: 'hidden'}
            ]        
            ,eventController: {
                onClickRow: function(tr) {
                    $('#procuraCliente').dialog('close');
                    $('#cpfcnpj').val(tr.cells[0].innerHTML);
                    $('#nomeBusca').val('');
                    $('#cpfcnpj').blur();
                }
            }  
        });
    };
    
    $('#nomeBusca').change(function(){
        gridClienteLoad();
    });
    
    // Função de Callback do Post do Formulario
    function showResponse(response){
        $('#msgAlerta').html(response.msg);
        $('#alertMessage').dialog('open');
    };
    
    // Função Responsável por desabilitar os botões
    function desabilitaBotoes(){
        $('#btnConfirmar').attr('disabled', 'disabled');
    };
    
    // Função Responsável pela Validação do Formulário
    function validaForm(){       
        // Verifica item a item do formulário           if(!$('#nome').val() || !$('#id').val()){
        if(!$('#nome').val()){
            $('#msgAlerta').html('Campo obrigatório não preenchido.');
            $('#alertMessage').dialog("open");
            return false; 
        }
    };    
 
     // Muda o Placeholder e a Máscara de acordo com a opção selecionada
    $('input[type=radio][name=rdTipoCliente]').change(function(){
        $('#cpfcnpj').val('');
        if($('#rdCPF').is(':checked')){
            $('#cpfcnpj').mask('999.999.999-99');
            $('#cpfcnpj').focus();
            $('#cpfcnpj').attr('placeholder','CPF Cliente');
        }else{
            $('#cpfcnpj').mask('99.999.999/9999-99');
            $('#cpfcnpj').focus();
            $('#cpfcnpj').attr('placeholder','CNPJ Cliente');
        }
        desabilitaBotoes();
    });
     
     // Muda o Placeholder e a Máscara de acordo com a opção selecionada
    $('input[type=radio][name=rdTipoProprietario]').change(function(){
        $('#cpfcnpjproprietario').val('');
        if($('#rdCPFProprietario').is(':checked')){
            $('#cpfcnpjproprietario').mask('999.999.999-99');
            $('#cpfcnpjproprietario').focus();
            $('#cpfcnpjproprietario').attr('placeholder','CPF Cliente');
        }else{
            $('#cpfcnpjproprietario').mask('99.999.999/9999-99');
            $('#cpfcnpjproprietario').focus();
            $('#cpfcnpjproprietario').attr('placeholder','CNPJ Cliente');
        }
    });
    
    $('#tipoBenfeitoria').change(function(){
       $('#unidadeBenfeitoria').val($(this).val());
    });
 
    // Grid com os imóveis rurais
    var $dgRurais = $('#gridRurais');
    var regRuralAnt;
    function gridRuraisLoad(){
        $dgRurais.datagrid({
            jsonStore: {
                url:' <?php echo base_url('cadCliente/dadosGridRurais?') ?>' + 'cpfcnpj=' + $('#cpfcnpj').val()
            },
            pagination: false,
            height: 50,
            mapper:
            [
                {name: 'id', hidden: 'hidden'},
                {name: 'nome', title: 'Nome', width: '150px', align: 'left'},            
                {name: 'especie', hidden: 'hidden'},
                {name: 'especieDesc', title: 'Espécie', width: '100px', align: 'left'},
                {name: 'matricula', title: 'Matrícula', width: '70px', align: 'left'},
                {name: 'registro', title: 'Cart. Registro', width: '100px', align: 'left'},
                {name: 'endereco', hidden: 'hidden'},
                {name: 'valorhectare', hidden: 'hidden'}
            ],
            eventController: {
                onClickRow: function(tr){
                    $(this).datagrid('selectRow',tr);
                    // Controle, desselecionar linha
                    if(regRuralAnt !== tr){
                        $(this).datagrid('clearSelectedRows');
                        $(this).datagrid('selectRow',tr);
                        $('#idImovel').val(tr.cells[0].innerHTML);
                        $('#endereco').val(tr.cells[6].innerHTML);
                        $('#valorhectare').val(tr.cells[7].innerHTML);
                        gridSoloLoad();
                        gridProprietarioLoad();
                        gridBenfeitoriaLoad();
                        $('#btnConfirmar').removeAttr('disabled');
                        regRuralAnt = tr;
                    }else{
                        $(this).datagrid('clearSelectedRows');
                        limparCamposImovel();
                        gridSoloLoad();
                        gridProprietarioLoad();
                        gridBenfeitoriaLoad();
                        desabilitaBotoes();
                        regRuralAnt = null;
                    }
                }
            }            
        });
    };
    gridRuraisLoad();
    
    /*
    *    GRID SOLO
    *    GRID SOLO
    */
    // Percorre o grid e cria um JSON para inserir no banco de dados
    function getDadosSoloGrid(){
        var rows = $dgSolo.datagrid('getRows');
        var txtReg = '[';
        for(i=0;i<rows.length;i++){
            // Limpa os valores pois o campo é float
            var area = rows[i].cells[1].innerHTML.split('.').join('');
            area = area.replace(',','.');
            // Cria o JSON o JSON
            txtReg +=  JSON.stringify({
                            'empresa': empresa,
                            'imovel': $('#idImovel').val(),
                            'cpfcnpj': $('#cpfcnpj').val().replace(/[^\d]+/g,''),
                            'tipo': rows[i].cells[0].innerHTML,
                            'area': area
                        }); 
            txtReg += ',';
        }
        // Retira a ultima vírgula
        txtReg = txtReg.substring(0,(txtReg.length - 1));
        txtReg += ']';
        $('#dadosSolo').val(txtReg);
    };
     
    function calculaValorTerraNua(){
        var valorhectare = $('#valorhectare').val().split('.').join('');
        valorhectare = valorhectare.replace(',','.');
        valorhectare = (!valorhectare) ? 0 : valorhectare;
        var areatotal = $('#areatotal').val().split('.').join('');
        areatotal = areatotal.replace(',','.');
        areatotal = (!areatotal) ? 0 : areatotal;

        var total = parseFloat(valorhectare) * parseFloat(areatotal);
        $('#valorterranua').val(total.toString().replace('.',','));
        $('#valorterranua').blur();
    }
    $('#valorhectare').keyup(calculaValorTerraNua);

    // Função calcular area total
    function calculaTotalAreaGrid(){
        var areaTotal = 0;
        var rows = $dgSolo.datagrid('getRows');
        for(i=0;i<rows.length;i++){
            // Limpa os valores pois o campo é float
            var varArea = rows[i].cells[1].innerHTML.split('.').join('').replace(',','.');
            varArea = (!varArea) ? 0 : varArea;
            areaTotal += parseFloat(varArea);
        }
        $('#areatotal').val(areaTotal.toString().replace('.',','));
        $('#areatotal').blur();
        calculaValorTerraNua();
    };
    
    // Grid com os imóveis usados na exploração
    var regSololAnt = null;
    var $dgSolo = $('#gridSolo');
    function gridSoloLoad(){
        $dgSolo.datagrid({
            jsonStore: {
                url:' <?php echo base_url('cadInformacoesImoveisRurais/dadosGridSolo?') ?>' + 'cpfcnpj=' + $('#cpfcnpj').val() + '&imovel=' + $('#idImovel').val()
            },
            pagination: false,
            height: 80,
            mapper:
            [
                {name: 'tipo', title: 'Tipo', width: '200px', align: 'center'},            
                {name: 'area', title: 'Área (ha)', width: '200px', align: 'center'},
                {name: 'hidden', hidden: 'hidden'}
            ],
            eventController: {
                onClickRow: function(tr){
                    $(this).datagrid('selectRow',tr);
                    // Controle, desselecionar linha
                    if(regSololAnt !== tr){
                        $(this).datagrid('clearSelectedRows');
                        $(this).datagrid('selectRow',tr);
                        $('#tipoUsoSolo').val(tr.cells[0].innerHTML);
                        $('#areaUsoSolo').val(tr.cells[1].innerHTML);
                        $('#btnRemSolo').button('enable');
                        $('#btnAddSolo').button('disable');
                        $('#tipoUsoSolo').attr('disabled', 'disabled');
                        $('#areaUsoSolo').attr('disabled', 'disabled');
                        regSololAnt = tr;
                    }else{
                        $(this).datagrid('clearSelectedRows');
                        regSololAnt = null;
                        $('#tipoUsoSolo').val('Agricultura - Lavouras anuais');
                        $('#areaUsoSolo').val('');
                        $('#btnRemSolo').button('disable');
                        $('#btnAddSolo').button('enable');
                        $('#tipoUsoSolo').removeAttr('disabled');
                        $('#areaUsoSolo').removeAttr('disabled');
                    }
                }
            },
            onAjaxSuccess: function(){calculaTotalAreaGrid();}
        });
    };
    gridSoloLoad();
    
    // Botões Grid Solo
    $('#btnAddSolo').click(function(event){
        event.preventDefault();
        var adicionarLinha = true;
        var rows = $dgSolo.datagrid('getRows');
        for(i=0;i<rows.length;i++){
            // Verifica se já existe o campo adicionado
            if($('#tipoUsoSolo').val() == rows[i].cells[0].innerHTML)
                adicionarLinha = false;
        }
        // Verifica se é para adicionar
        if(adicionarLinha){
            var obJson = {
                'tipo': $('#tipoUsoSolo').val(),
                'area': $('#areaUsoSolo').val()
            };
            $dgSolo.datagrid('addRow', [obJson]);
            $dgSolo.datagrid('clearSelectedRows');
            $('#btnRemSolo').button('disable');
            $('#tipoUsoSolo').val('Agricultura - Lavouras anuais');
            $('#areaUsoSolo').val('');
            calculaTotalAreaGrid();
        }else{
            $('#msgAlerta').html($('#tipoUsoSolo').val() + ' <br/> Já adicionado.');
            $('#alertMessage').dialog('open');
        }
    });
    
    $('#btnRemSolo').click(function(event){
        event.preventDefault();
        regSololAnt.remove();
        regSololAnt = null;
        $('#tipoUsoSolo').val('Agricultura - Lavouras anuais');
        $('#areaUsoSolo').val('');
        $('#btnRemSolo').button('disable');
        $('#btnAddSolo').button('enable');
        $('#tipoUsoSolo').removeAttr('disabled');
        $('#areaUsoSolo').removeAttr('disabled');
        calculaTotalAreaGrid();
    });
    
    /*
     *  GRID PROPRIETÁRIOS
     */
    
    // Percorre o grid e cria um JSON para inserir no banco de dados
    function getDadosProprietarioGrid(){
        var rows = $dgProprietario.datagrid('getRows');
        var txtReg = '[';
        for(i=0;i<rows.length;i++){
            // Cria o JSON o JSON
            txtReg +=  JSON.stringify({
                            'empresa': empresa,
                            'imovel': $('#idImovel').val(),
                            'cpfcnpj': $('#cpfcnpj').val().replace(/[^\d]+/g,''),
                            'cpfcnpjproprietario': rows[i].cells[0].innerHTML.replace(/[^\d]+/g,''),
                            'nome': rows[i].cells[1].innerHTML,
                            'part': rows[i].cells[2].innerHTML
                        }); 
            txtReg += ',';
        }
        // Retira a ultima vírgula
        txtReg = txtReg.substring(0,(txtReg.length - 1));
        txtReg += ']';
        $('#dadosProprietario').val(txtReg);
    };
    
    var regProprietarioAnt = null;
    var $dgProprietario = $('#gridProprietario');
    function gridProprietarioLoad(){
        $dgProprietario.datagrid({
            jsonStore: {
                url:' <?php echo base_url('cadInformacoesImoveisRurais/dadosGridProprietario?') ?>' + 'cpfcnpj=' + $('#cpfcnpj').val() + '&imovel=' + $('#idImovel').val()
            },
            pagination: false,
            height: 130,
            mapper:
            [
                {name: 'cpfcnpjproprietario', title: 'CPF/CNPJ', width: '300px', align: 'center'},            
                {name: 'nome', title: 'Nome', width: '320px', align: 'center'},
                {name: 'part', title: 'Part (%)', width: '170px', align: 'center'},
                {name: 'hidden', hidden: 'hidden'}
            ],
            eventController: {
                onClickRow: function(tr){
                    $(this).datagrid('selectRow',tr);
                    // Controle, desselecionar linha
                    if(regProprietarioAnt !== tr){
                        $(this).datagrid('clearSelectedRows');
                        $(this).datagrid('selectRow',tr);
                        $('#cpfcnpjproprietario').val(tr.cells[0].innerHTML);
                        $('#nomeproprietario').val(tr.cells[1].innerHTML);
                        $('#partproprietario').val(tr.cells[2].innerHTML);
                        $('#btnRemProprietario').button('enable');
                        $('#btnAddProprietario').button('disable');
                        $('#cpfcnpjproprietario').attr('disabled', 'disabled');
                        $('#nomeproprietario').attr('disabled', 'disabled');
                        $('#partproprietario').attr('disabled', 'disabled');
                        regProprietarioAnt = tr;
                    }else{
                        $(this).datagrid('clearSelectedRows');
                        regProprietarioAnt = null;
                        $('#cpfcnpjproprietario').val('');
                        $('#nomeproprietario').val('');
                        $('#partproprietario').val('');
                        $('#btnRemProprietario').button('disable');
                        $('#btnAddProprietario').button('enable');
                        $('#cpfcnpjproprietario').removeAttr('disabled');
                        $('#nomeproprietario').removeAttr('disabled');
                        $('#partproprietario').removeAttr('disabled');
                    }
                }
            },
            onAjaxSuccess: function(){calculaTotalAreaGrid();}
        });
    };
    gridProprietarioLoad();

    // Botões Grid Proprietario
    $('#btnAddProprietario').click(function(event){
        event.preventDefault();
        if(!$('#cpfcnpjproprietario').val() && !$('#nomeproprietario').val() && !$('#partproprietario').val()){
            $('#msgAlerta').html('Campos Obrigatórios Vazios.');
            $('#alertMessage').dialog('open');
        }else{
            // Verifica se é para adicionar
            var obJson = {
                'cpfcnpjproprietario': $('#cpfcnpjproprietario').val(),
                'nome': $('#nomeproprietario').val(),
                'part': $('#partproprietario').val()
            };
            $dgProprietario.datagrid('addRow', [obJson]);
            $dgProprietario.datagrid('clearSelectedRows');
            $('#btnRemProprietario').button('disable');
            $('#cpfcnpjproprietario').val('');
            $('#nomeproprietario').val('');
            $('#partproprietario').val('');
        }
    });
    
    $('#btnRemProprietario').click(function(event){
        event.preventDefault();
        regProprietarioAnt.remove();
        regProprietarioAnt = null;
        $('#cpfcnpjproprietario').val('');
        $('#nomeproprietario').val('');
        $('#partproprietario').val('');
        $('#btnRemProprietario').button('disable');
        $('#btnAddProprietario').button('enable');
        $('#cpfcnpjproprietario').removeAttr('disabled');
        $('#nomeproprietario').removeAttr('disabled');
        $('#partproprietario').removeAttr('disabled');
    });

    /*
     *  GRID Benfeitoria
     */
    // Percorre o grid e cria um JSON para inserir no banco de dados
    function getDadosBenfeitoriaGrid(){
        var rows = $dgBenfeitoria.datagrid('getRows');
        var txtReg = '[';
        for(i=0;i<rows.length;i++){
            // Limpa os valores pois o campo é float
            var dimensao = rows[i].cells[2].innerHTML.split('.').join('');
            dimensao = dimensao.replace(',','.');
            var valor = rows[i].cells[5].innerHTML.split('.').join('');
            valor = valor.replace(',','.');
            // Cria o JSON o JSON
            txtReg +=  JSON.stringify({
                            'empresa': empresa,
                            'imovel': $('#idImovel').val(),
                            'cpfcnpj': $('#cpfcnpj').val().replace(/[^\d]+/g,''),
                            'benfeitoria': rows[i].cells[0].innerHTML,
                            'dimensao': dimensao,
                            'idade': rows[i].cells[4].innerHTML,
                            'valor': valor
                        }); 
            txtReg += ',';
        }
        // Retira a ultima vírgula
        txtReg = txtReg.substring(0,(txtReg.length - 1));
        txtReg += ']';
        $('#dadosBenfeitoria').val(txtReg);
    };
    
    var regBenfeitoriaAnt = null;
    var $dgBenfeitoria = $('#gridBenfeitoria');
    function gridBenfeitoriaLoad(){
        $dgBenfeitoria.datagrid({
            jsonStore: {
                url:' <?php echo base_url('cadInformacoesImoveisRurais/dadosGridBenfeitoria?') ?>' + 'cpfcnpj=' + $('#cpfcnpj').val() + '&imovel=' + $('#idImovel').val()
            },
            pagination: false,
            height: 150,
            mapper:
            [
                {name: 'benfeitoria',  hidden: 'hidden'},
                {name: 'benfeitoriaDesc', title: 'Tipo', width: '320px', align: 'center'},
                {name: 'dimensao', title: 'Dimensao', width: '150px', align: 'center'},
                {name: 'unidade', title: 'Unidade', width: '85px', align: 'center'},
                {name: 'idade', title: 'Idade', width: '110px', align: 'center'},
                {name: 'valor', title: 'Valor', width: '110px', align: 'center'},
                {name: 'hidden', hidden: 'hidden'}
            ],
            eventController: {
                onClickRow: function(tr){
                    $(this).datagrid('selectRow',tr);
                    // Controle, desselecionar linha
                    if(regBenfeitoriaAnt !== tr){
                        $(this).datagrid('clearSelectedRows');
                        $(this).datagrid('selectRow',tr);
                        $('#tipoBenfeitoria').val(tr.cells[0].innerHTML);
                        $('#dimensaoBenfeitoria').val(tr.cells[2].innerHTML);
                        $('#unidadeBenfeitoria').val(tr.cells[0].innerHTML);
                        $('#idadeBenfeitoria').val(tr.cells[4].innerHTML);
                        $('#valorBenfeitoria').val(tr.cells[5].innerHTML);
                        $('#btnRemBenfeitoria').button('enable');
                        $('#btnAddBenfeitoria').button('disable');
                        $('#tipoBenfeitoria').attr('disabled', 'disabled');
                        $('#dimensaoBenfeitoria').attr('disabled', 'disabled');
                        $('#idadeBenfeitoria').attr('disabled', 'disabled');
                        $('#valorBenfeitoria').attr('disabled', 'disabled');
                        regBenfeitoriaAnt = tr;
                    }else{
                        $(this).datagrid('clearSelectedRows');
                        regBenfeitoriaAnt = null;
                        $('#tipoBenfeitoria').val('1');
                        $('#dimensaoBenfeitoria').val('');
                        $('#unidadeBenfeitoria').val('1');
                        $('#idadeBenfeitoria').val('');
                        $('#valorBenfeitoria').val('');
                        $('#btnRemBenfeitoria').button('disable');
                        $('#btnAddBenfeitoria').button('enable');
                        $('#tipoBenfeitoria').removeAttr('disabled');
                        $('#dimensaoBenfeitoria').removeAttr('disabled');
                        $('#idadeBenfeitoria').removeAttr('disabled');
                        $('#valorBenfeitoria').removeAttr('disabled');
                    }
                }
            },
            onAjaxSuccess: function(){calculaTotalAreaGrid();}
        });
    };
    gridBenfeitoriaLoad();

    // Botões Grid Benfeitoria
    $('#btnAddBenfeitoria').click(function(event){
        event.preventDefault();        
        var adicionarLinha = true;
        var rows = $dgBenfeitoria.datagrid('getRows');
        for(i=0;i<rows.length;i++){
            // Verifica se já existe o campo adicionado
            if($('#tipoBenfeitoria').val() == rows[i].cells[0].innerHTML)
                adicionarLinha = false;
        }
        // Verifica se é para adicionar
        if(adicionarLinha){
            // Verifica se é para adicionar
            var obJson = {
                'benfeitoria': $('#tipoBenfeitoria').val(),
                'benfeitoriaDesc': $('#tipoBenfeitoria option:selected').text(),
                'dimensao': $('#dimensaoBenfeitoria').val(),
                'unidade': $('#unidadeBenfeitoria option:selected').text(),
                'idade': $('#idadeBenfeitoria').val(),
                'valor': $('#valorBenfeitoria').val()
            };
            $dgBenfeitoria.datagrid('addRow', [obJson]);
            $dgBenfeitoria.datagrid('clearSelectedRows');
            $('#btnRemBenfeitoria').button('disable');
            $('#tipoBenfeitoria').val('1');
            $('#dimensaoBenfeitoria').val('');
            $('#unidadeBenfeitoria').val('1');
            $('#idadeBenfeitoria').val('');
            $('#valorBenfeitoria').val('');
        }else{
            $('#msgAlerta').html($('#tipoBenfeitoria option:selected').text() + ' <br/> Já adicionado.');
            $('#alertMessage').dialog('open');
        }
    });
    
    $('#btnRemBenfeitoria').click(function(event){
        event.preventDefault();
        regBenfeitoriaAnt.remove();
        regBenfeitoriaAnt = null;
        $('#tipoBenfeitoria').val('1');
        $('#dimensaoBenfeitoria').val('');
        $('#unidadeBenfeitoria').val('1');
        $('#idadeBenfeitoria').val('');
        $('#valorBenfeitoria').val('');
        $('#btnRemBenfeitoria').button('disable');
        $('#btnAddBenfeitoria').button('enable');
        $('#tipoBenfeitoria').removeAttr('disabled');
        $('#dimensaoBenfeitoria').removeAttr('disabled');
        $('#idadeBenfeitoria').removeAttr('disabled');
        $('#valorBenfeitoria').removeAttr('disabled');
    });

    function limparCamposImovel(){
        // Solo
        $('#tipoUsoSolo').val('Agricultura - Lavouras anuais');
        $('#areaUsoSolo').val('');
        $('#btnRemSolo').button('disable');
        $('#btnAddSolo').button('enable');
        $('#tipoUsoSolo').removeAttr('disabled');
        $('#areaUsoSolo').removeAttr('disabled');
        
        // Proprietarios
        $('#cpfcnpjproprietario').val('');
        $('#nomeproprietario').val('');
        $('#partproprietario').val('');
        $('#btnRemProprietario').button('disable');
        $('#btnAddProprietario').button('enable');
        $('#cpfcnpjproprietario').removeAttr('disabled');
        $('#nomeproprietario').removeAttr('disabled');
        $('#partproprietario').removeAttr('disabled');
        
        // Benfeitoria
        $('#tipoBenfeitoria').val('1');
        $('#dimensaoBenfeitoria').val('');
        $('#unidadeBenfeitoria').val('1');
        $('#idadeBenfeitoria').val('');
        $('#valorBenfeitoria').val('');
        $('#btnRemBenfeitoria').button('disable');
        $('#btnAddBenfeitoria').button('enable');
        $('#tipoBenfeitoria').removeAttr('disabled');
        $('#dimensaoBenfeitoria').removeAttr('disabled');
        $('#idadeBenfeitoria').removeAttr('disabled');
        $('#valorBenfeitoria').removeAttr('disabled');
        
        // Roteiro de acesso
        $('#idImovel').val('');
        $('#endereco').val('');
        $('#valorhectare').val('');
    };
    
    // Ação dos Botões
    $('#btnConfirmar').click(function(){
        getDadosSoloGrid();
        getDadosProprietarioGrid();
        getDadosBenfeitoriaGrid();
        $('#frmCadInformacoesImoveisRurais').ajaxForm({
            clearForm: false,
            beforeSubmit: validaForm,
            success: showResponse,
            url: '<?php echo base_url('CadInformacoesImoveisRurais/confirmar') ?>',
            type:'post',
            dataType : 'json'
        }); 
        $('#frmCadInformacoesImoveisRurais').submit();
    });

    $('#btnFechar').click(function(){
        $('#janelaPrincipal').dialog('close');
    });
    
    $('#btnLimpar').click(function(){
        limparForm();
    });
    
    function limparForm(){
        $('#frmCadInformacoesImoveisRurais').resetForm();
        $('#cpfcnpj').focus();
        desabilitaBotoes();
        gridRuraisLoad();
        gridSoloLoad();
        gridBenfeitoriaLoad();
        gridProprietarioLoad();
        cpfcnpjAnterior = '';
    };
    
    $('#cpfcnpjproprietario').blur(function(){
        if(!validarCPFCNPJ($('#cpfcnpjproprietario').val())){
            $('#msgAlerta').html('CPF ou CNPJ Inválido');
            $('#alertMessage').dialog('open');
        }
    });
    
    var cpfcnpjAnterior = '';
    function cpfcnpjBlur(){
        if(cpfcnpjAnterior !== $('#cpfcnpj').val().replace(/[^\d]+/g,'') && !($('#rdCNPJ').is(':checked') && $('#cpfcnpj').val().replace(/[^\d]+/g,'').length < 14) ){           
            if(validarCPFCNPJ($('#cpfcnpj').val())){
                $.post('<?php echo base_url('ImpProjetoCliente/buscaRegistro') ?>',{
                    cpfcnpj : $('#cpfcnpj').val()
                }, function(data){
                    if(data.msg == ''){
                        $('#nome').val(data.nome);
                        gridRuraisLoad();
                    }else{
                        $('#msgAlerta').html(data.msg);
                        $('#alertMessage').dialog('open');
                        limparForm();
                    }
                },'json');
            }else{
                $('#msgAlerta').html('CPF ou CNPJ Inválido');
                $('#alertMessage').dialog('open');
                limparForm();
            }
        }
        cpfcnpjAnterior = $('#cpfcnpj').val().replace(/[^\d]+/g,'');
    };
    
    // Atribui com o replace para remover a máscara
    function cpfcnpjFocus(){
        cpfcnpjAnterior = $('#cpfcnpj').val().replace(/[^\d]+/g,'');
    };
    $('#cpfcnpj').blur(cpfcnpjBlur);
    $('#cpfcnpj').focus(cpfcnpjFocus);
});
</script>