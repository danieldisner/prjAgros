<div id='janelaPrincipal' title='Controle Processos' style='display: none'>
    <div class='form-dialog-ui' style='height: 100%'>
        <form id='frmControleProcessos' method='post'>
            <div class='form-group' style='height: 300px'>
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
                <div class='row' class='groupBotoes' style='text-align: center'>
                    <h3>Acompanhamento dos Status das Operações</h3>
                </div>
                <div id='dadosOperacao' class='row'>
                    <div class='col-xs-1'>
                        <label class='control-label'>Procura</label>
                        <button id='btnProcControle' name='btnProcControle' class='form-control jqbutton'/><span class='glyphicon glyphicon-search'></span></button>
                    </div>
                    <div class='col-xs-3'>
                        <label class='control-label'>Tipo</label>
                        <select class='form-control' id='tipooperacao' name='tipooperacao'>
                            <option value='AGRÍCOLA'>AGRÍCOLA</option>
                            <option value='PECUÁRIA'>PECUÁRIA</option>
                        </select>
                    </div>
                    <div class='col-xs-4'>
                        <label class='control-label'>Finalidade</label>
                        <select class='form-control' id='finalidade' name='finalidade'>
                            <option value='CUSTEIO'>CUSTEIO</option>
                            <option value='INVESTIMENTO'>INVESTIMENTO</option>
                            <option value='COMERCIALIZAÇÃO'>COMERCIALIZAÇÃO</option>
                        </select>
                    </div>
                    <div class='col-xs-1'>
                        <label class='control-label'>Ciclo</label>
                        <input type='text' class='form-control onlynumbers required' id='ciclocanoinicio' name='ciclocanoinicio' placeholder='ano'/>
                    </div>
                    <div class='col-xs-1'>
                        <label class='control-label'></label>
                        <input type='text' class='form-control onlynumbers required' id='ciclocanofim' name='ciclocanofim' placeholder='ano'/>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-xs-3'>
                        <label class='control-label'>Status</label>
                        <select class='form-control' id='status' name='status'>
                            <option value='PROJETO'>PROJETO</option>
                            <option value='ANÁLISE'>ANÁLISE</option>
                        </select>
                    </div>
                    <div id='camposProjeto'>
                        <div class='col-xs-2'>
                            <label class='control-label'>Linha de Crédito</label>
                            <input type='text' class='form-control' id='linhacreditoprojeto' name='linhacreditoprojeto' placeholder='Linha de Crédito'/>
                        </div>
                        <div class='col-xs-2'>
                            <label class='control-label'>Taxa Juros</label>
                            <input type='text' class='form-control decimal' id='taxajurosprojeto' name='taxajurosprojeto' placeholder='Taxa de Juros'/>
                        </div>
                        <div class='col-xs-2' style='min-width: 110px'>
                            <label class='control-label'>Data Início</label>
                            <input type='text' class='form-control datepicker' id='datainicioprojeto' name='datainicioprojeto' placeholder='Data'/>
                        </div>
                            <div class='col-xs-2' style='min-width: 110px'>
                            <label class='control-label'>Data Conclusão</label>
                            <input type='text' class='form-control datepicker' id='dataconclusaoprojeto' name='dataconclusaoprojeto' placeholder='Data'/>
                        </div>
                    </div>
                    <div id='camposAnalise' style='display: none'>
                        <div class='col-xs-2'>
                            <label class='control-label'>Análise</label>
                            <select class='form-control' id='aprovado' name='aprovado'>
                                <option value='1'>APROVADO</option>
                                <option value='0'>NEGADO</option>
                            </select>
                        </div>
                        <div id='camposAnaliseAprovado'>
                            <div class='col-xs-2'>
                                <label class='control-label'>Linha de Crédito</label>
                                <input type='text' class='form-control' id='linhacreditoanalise' name='linhacreditoanalise' placeholder='Linha de Crédito'/>
                            </div>
                            <div class='col-xs-2' style='min-width: 110px'>
                                <label class='control-label'>Data Liberação</label>
                                <input type='text' class='form-control datepicker' id='dataliberacaoanalise' name='dataliberacaoanalise' placeholder='Data'/>
                            </div>
                            <div class='col-xs-2'>
                                <label class='control-label'>Taxa Juros</label>
                                <input type='text' class='form-control decimal' id='taxajurosanalise' name='taxajurosanalise' placeholder='Taxa de Juros'/>
                            </div>
                            <div class='col-xs-2'>
                                <label class='control-label'>Prazo</label>
                                <input type='text' class='form-control datepicker' id='prazoanalise' name='prazoanalise' placeholder='Prazo'/>
                            </div>
                            <div class='col-xs-2' style='min-width: 110px'>
                                <label class='control-label'>Data Reembolso</label>
                                <input type='text' class='form-control datepicker' id='datareembolsoanalise' name='datareembolsoanalise' placeholder='Data'/>
                            </div>
                        </div>
                        <div id='camposAnaliseNegado' style='display:none'>
                            <div class='col-xs-2' style='min-width: 110px'>
                                <label class='control-label'>Data Conclusão</label>
                                <input type='text' class='form-control datepicker' id='dataconclusaoanalise' name='dataconclusaoanalise' placeholder='Data'/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
            <div class='groupBotoes'>
                <input type='button' id='btnIncluir' name='btnIncluir' class='btn btn-lg btn-default' disabled='disabled' value='Incluir'/>
                <input type='button' id='btnAlterar' name='btnAlterar' class='btn btn-lg btn-default' disabled='disabled' value='Alterar'/>
                <input type='button' id='btnExcluir' name='btnExcluir' class='btn btn-lg btn-default' disabled='disabled' value='Excluir'/>
                <input type='button' id='btnCancelar' name='btnCancelar' class='btn btn-lg btn-default' value='Cancelar'/>
                <input type='button' id='btnFechar' name='btnFechar' class='btn btn-lg btn-default' value='Fechar'/>
            </div>
        </form>
    </div>
</div>
<div id='procuraControle' title='Procura Controle Processos' style='display: none'>
    <div id='gridOperacoes'></div>
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
        height: '430',
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
       
    $(':checkbox').change(function(){
        if($(this).prop('checked'))
            $(this).next('span').text('SIM');
        else $(this).next('span').text('NÃO');
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

    // Tela de Procura de Exploracao
    $('#procuraControle').dialog({
        dialogClass: 'no-close',
        width: '54%',
        height: '345',
        resizable: false,
        modal: true,
        autoOpen: false,
        buttons: {
            'Fechar': function(){
                $(this).dialog('close');
            }
        }
    });
    
    // Função de Callback do Post do Formulario
    function showResponse(response){
        $('#msgAlerta').html(response.msg);
        $('#alertMessage').dialog('open');
        gridLoad();
        $dgLocal.datagrid('clearSelectedRows');
        limparCamposOperacao();
    };
    
    // Função Responsável por desabilitar os botões
    function desabilitaBotoes(){
        $('#btnIncluir').attr('disabled', 'disabled');
        $('#btnAlterar').attr('disabled', 'disabled');
        $('#btnExcluir').attr('disabled', 'disabled');
    };
    
    // Função Responsável pela Validação do Formulário
    function validaForm(){       
        // Verifica item a item do formulário
        if(!validarCamposDiv('#dadosOperacao')){
            $('#msgAlerta').html('Campos obrigatórios não preenchidos.');
            $('#alertMessage').dialog('open');
            return false; 
        }
    };
    
    // Função responsável pelo carregamento do grid
    var $dgLocal = $('#gridOperacoes');
    var regAnterior;
    function gridLoad(){
        $dgLocal.datagrid({
            jsonStore: {
                url:' <?php echo base_url('controleProcessos/dadosGrid?') ?>' + 'cpfcnpj=' + $('#cpfcnpj').val()
            },
            pagination: false,
            mapper:
            [
                {name: 'tipooperacao',title: 'Operação',width: 100,align: 'center'},
                {name: 'finalidade',title: 'Finalidade',width: 150},
                {name: 'ciclocanoinicio', title: 'Ciclo (ano1)',width: 100},
                {name: 'ciclocanofim', title: 'Ciclo (ano2)',width: 100},
                {name: 'status', title: 'Status',width: 100},
                {name: 'linhacreditoprojeto', hidden: 'hidden'},
                {name: 'taxajurosprojeto', hidden: 'hidden'},
                {name: 'datainicioprojeto', hidden: 'hidden'},
                {name: 'dataconclusaoprojeto', hidden: 'hidden'},
                {name: 'aprovado', hidden: 'hidden'},
                {name: 'linhacreditoanalise', hidden: 'hidden'},
                {name: 'dataliberacaoanalise', hidden: 'hidden'},
                {name: 'taxajurosanalise', hidden: 'hidden'},
                {name: 'prazoanalise', hidden: 'hidden'},
                {name: 'datareembolsoanalise', hidden: 'hidden'},                
                {name: 'dataconclusaoanalise', hidden: 'hidden'}
            ],
            eventController: {
                onClickRow: function(tr) {
                    $(this).datagrid('selectRow',tr);
                    if(regAnterior !== tr){
                        $(this).datagrid('clearSelectedRows');
                        $(this).datagrid('selectRow',tr);
                        $('#tipooperacao').val(tr.cells[0].innerHTML);
                        $('#finalidade').val(tr.cells[1].innerHTML);
                        $('#ciclocanoinicio').val(tr.cells[2].innerHTML);
                        $('#ciclocanofim').val(tr.cells[3].innerHTML);
                        $('#status').val(tr.cells[4].innerHTML);
                        $('#linhacreditoprojeto').val(tr.cells[5].innerHTML);
                        $('#taxajurosprojeto').val(tr.cells[6].innerHTML);
                        $('#datainicioprojeto').val(tr.cells[7].innerHTML);
                        $('#dataconclusaoprojeto').val(tr.cells[8].innerHTML);
                        $('#aprovado').val(tr.cells[9].innerHTML);
                        $('#linhacreditoanalise').val(tr.cells[10].innerHTML);
                        $('#dataliberacaoanalise').val(tr.cells[11].innerHTML);
                        $('#taxajurosanalise').val(tr.cells[12].innerHTML);
                        $('#prazoanalise').val(tr.cells[13].innerHTML);
                        $('#datareembolsoanalise').val(tr.cells[14].innerHTML);
                        $('#dataconclusaoanalise').val(tr.cells[15].innerHTML);
                        $('#status').change();
                        $('#aprovado').change();
                        $('#btnIncluir').attr('disabled', 'disabled');
                        $('#btnAlterar').removeAttr('disabled');
                        $('#btnExcluir').removeAttr('disabled');
                        regAnterior = tr;
                        $('#procuraControle').dialog('close');
                    }
                }
            }  
        });
    };
    
    
        // Botão de Procura de Agência
    $('#btnProcControle').click(function(event){
        event.preventDefault();
        gridLoad();
        $('#procuraControle').dialog('open');
    });
 
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
    
    // Muda valor
    $('#status').change(function(){
        if($(this).val() == 'ANÁLISE'){
            $('#camposAnalise').show();
            $('#camposProjeto').hide();
            $('#camposProjeto input').val('');
        }else{
            $('#camposProjeto').show();
            $('#camposAnalise').hide();
            $('#camposAnalise input').val('');
        }
    });
    
    $('#aprovado').change(function(){
        if($(this).val() == 1){
            $('#camposAnaliseAprovado').show();
            $('#camposAnaliseNegado').hide();
            $('#camposAnaliseNegado input').val('');
        }else{
            $('#camposAnaliseNegado').show();
            $('#camposAnaliseAprovado').hide();
            $('#camposAnaliseAprovado input').val('');
        }
    });
   
       // Ação dos Botões
    $('#btnIncluir').click(function(){
        $('#frmControleProcessos').ajaxForm({
            clearForm: false,
            beforeSubmit: validaForm,
            success: showResponse,
            url: '<?php echo base_url('ControleProcessos/incluir') ?>',
            type:'post',
            dataType : 'json'
        }); 
        $('#frmControleProcessos').submit();
    });
   
    // Ação dos Botões
    $('#btnAlterar').click(function(){
        $('#frmControleProcessos').ajaxForm({
            clearForm: false,
            beforeSubmit: validaForm,
            success: showResponse,
            url: '<?php echo base_url('ControleProcessos/alterar') ?>',
            type:'post',
            dataType : 'json'
        }); 
        $('#frmControleProcessos').submit();
    });
    
    // Ação dos Botões
    $('#btnExcluir').click(function(){
        $('#frmControleProcessos').ajaxForm({
            clearForm: false,
            success: showResponse,
            url: '<?php echo base_url('ControleProcessos/excluir') ?>',
            type:'post',
            dataType : 'json'
        }); 
        $('#frmControleProcessos').submit();
    });

    $('#btnFechar').click(function(){
        $('#janelaPrincipal').dialog('close');
    });
    
    $('#btnCancelar').click(function(){
        limparForm();
    });
    
    function limparForm(){
        $('#frmControleProcessos').resetForm();
        $('#cpfcnpj').focus();
        autorizaBuscaOperacao = false;
        desabilitaBotoes();
        cpfcnpjAnterior = '';
    };
    
    function limparCamposOperacao(){
        $('#tipooperacao').val('AGRÍCOLA');
        $('#finalidade').val('CUSTEIO');
        $('#ciclocanoinicio').val('');
        $('#ciclocanofim').val('');
        $('#status').val('PROJETO');
        $('#linhacreditoprojeto').val('');
        $('#taxajurosprojeto').val('');
        $('#datainicioprojeto').val('');
        $('#dataconclusaoprojeto').val('');
        $('#aprovado').val('1');
        $('#linhacreditoanalise').val('');
        $('#dataliberacaoanalise').val('');
        $('#taxajurosanalise').val('');
        $('#prazoanalise').val('');
        $('#datareembolsoanalise').val('');
        $('#dataconclusaoanalise').val('');
        $('#status').change();
        $('#aprovado').change();
        $('#btnIncluir').attr('disabled','disabled');
        $('#btnAlterar').attr('disabled','disabled');
        $('#btnExcluir').attr('disabled','disabled');
    }
    
    // Variável de controle de busca
    var autorizaBuscaOperacao = false;
    
    var cpfcnpjAnterior = '';
    function cpfcnpjBlur(){
        if(cpfcnpjAnterior !== $('#cpfcnpj').val().replace(/[^\d]+/g,'') && !($('#rdCNPJ').is(':checked') && $('#cpfcnpj').val().replace(/[^\d]+/g,'').length < 14) ){           
            if(validarCPFCNPJ($('#cpfcnpj').val())){
                $.post('<?php echo base_url('ImpProjetoCliente/buscaRegistro') ?>',{
                    cpfcnpj : $('#cpfcnpj').val()
                }, function(data){
                    if(data.msg == ''){
                        $('#nome').val(data.nome);
                        autorizaBuscaOperacao = true;
                        gridLoad();
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
    
    function procuraControleProcesso(){
        if(autorizaBuscaOperacao){
            $.post('<?php echo base_url('controleProcessos/buscaRegistro') ?>',{
                cpfcnpj : $('#cpfcnpj').val(),
                tipooperacao : $('#tipooperacao').val(),
                finalidade : $('#finalidade').val(),
                ciclocanoinicio : $('#ciclocanoinicio').val(),
                ciclocanofim : $('#ciclocanofim').val()            
            }, function(data){
                    $('#status').val(data.status);
                    $('#linhacreditoprojeto').val(data.linhacreditoprojeto);
                    $('#taxajurosprojeto').val(data.taxajurosprojeto);
                    $('#datainicioprojeto').val(data.datainicioprojeto);
                    $('#dataconclusaoprojeto').val(data.dataconclusaoprojeto);
                    $('#aprovado').val(data.aprovado);
                    $('#linhacreditoanalise').val(data.linhacreditoanalise);
                    $('#dataliberacaoanalise').val(data.dataliberacaoanalise);
                    $('#taxajurosanalise').val(data.taxajurosanalise);
                    $('#prazoanalise').val(data.prazoanalise);
                    $('#datareembolsoanalise').val(data.datareembolsoanalise);
                    $('#dataconclusaoanalise').val(data.dataconclusaoanalise);
                    $('#status').change();
                    $('#aprovado').change();
                    (data.btnIncluir !== true) ? $('#btnIncluir').attr('disabled', 'disabled') : $('#btnIncluir').removeAttr('disabled');
                    (data.btnAlterar !== true) ? $('#btnAlterar').attr('disabled', 'disabled') : $('#btnAlterar').removeAttr('disabled');
                    (data.btnExcluir !== true) ? $('#btnExcluir').attr('disabled', 'disabled') : $('#btnExcluir').removeAttr('disabled');
            },'json');
        }
    };
    
    $('#tipooperacao').change(procuraControleProcesso);
    $('#finalidade').change(procuraControleProcesso);
    $('#ciclocanoinicio').change(procuraControleProcesso);
    $('#ciclocanofim').change(procuraControleProcesso);
});
</script>