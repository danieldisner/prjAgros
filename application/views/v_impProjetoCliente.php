<div id='janelaPrincipal' title='Impressão de Cadastro do Cliente' style='display: none'>
    <div class='form-dialog-ui'>
        <form id='frmImpProjetoCliente' method='post' action='<?php echo base_url('ImpProjetoCliente/imprimirPDF') ?>'>
            <div class='form-group'>
                <div class='row'>
                    <div class='col-xs-1'>
                        <label for='btnProcCliente'></label>
                    </div>
                    <div id='rdGroup' class='col-xs-10'>
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
                <div class='row'>
                    <div class='col-xs-12'>
                        <input type='checkbox' id='chkTodos' name='chkTodos' checked='true' class='chk form-control'><label for='chkTodos'>Desmarcar Todos</label>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-xs-6'>
                        <input type='checkbox' id='chkRosto' name='chkRosto' checked='true' class='chk chkOpt'><label style='width: 15%;max-height: 25px' for='chkRosto'><spam>&nbsp;</spam></label> Folha de Rosto(Cliente/Empresa)
                    </div>
                    <div class='col-xs-6'>
                        <input type='checkbox' id='chkMoveis' name='chkMoveis' checked='true' class='chk chkOpt'><label style='width: 15%;max-height: 25px' for='chkMoveis'><spam>&nbsp;</spam></label> Relação de Bens Móveis
                    </div>
                    <div class='col-xs-6'>
                        <input type='checkbox' id='chkSemoventes' name='chkSemoventes' checked='true' class='chk chkOpt'><label style='width: 15%;max-height: 25px' for='chkSemoventes'><spam>&nbsp;</spam></label> Relação de Semoventes
                    </div>
                    <div class='col-xs-6'>
                        <input type='checkbox' id='chkAgricola' name='chkAgricola' checked='true' class='chk chkOpt'><label style='width: 15%;max-height: 25px' for='chkAgricola'><spam>&nbsp;</spam></label> Produção Agrícola
                    </div>
                    <div class='col-xs-6'>
                        <input type='checkbox' id='chkImoveisRurais' name='chkImoveisRurais' checked='true' class='chk chkOpt'><label style='width: 15%;max-height: 25px' for='chkImoveisRurais'><spam>&nbsp;</spam></label> Relação de Bens Imóveis Rurais
                    </div>
                    <div class='col-xs-6'>
                        <input type='checkbox' id='chkPecuaria' name='chkPecuaria' checked='true' class='chk chkOpt'><label style='width: 15%;max-height: 25px' for='chkPecuaria'><spam>&nbsp;</spam></label> Produção Pecuária
                    </div>
                    <div class='col-xs-6'>
                        <input type='checkbox' id='chkImoveisUrbano' name='chkImoveisUrbano' checked='true' class='chk chkOpt'><label style='width: 15%;max-height: 25px' for='chkImoveisUrbano'><spam>&nbsp;</spam></label> Relação de Bens Imóveis Urbanos
                    </div>
                    <div class='col-xs-6'>
                        <input type='checkbox' id='chkResumoAgropecuaria' checked='true' name='chkResumoAgropecuaria' class='chk chkOpt'><label style='width: 15%;max-height: 25px' for='chkResumoAgropecuaria'><spam>&nbsp;</spam></label> Resumo da Produção Agropecuária
                    </div>
                </div>
                <div class='row'>
                    <div class='col-xs-7' >
                        <label class='control-label'>Responsável Técnico</label>
                        <select class='form-control' id='responsavel' name='responsavel'>
                            <?php foreach($tiposImovel as $tipoImovel){ ?>
                                <option value='<?php echo $tipoImovel['id']?>'><?php echo $tipoImovel['nome']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class='col-xs-2' style='min-width: 110px'>
                        <label class='control-label'>Data Retroativa</label>
                        <input type='text' class='form-control datepicker' id='dataRetroativa' name='dataRetroativa' placeholder='Data'/>
                    </div>
                    <div class='col-xs-1 '>
                        <label class='control-label'>Margem</label>
                        <input type='checkbox' id='chkMargem' name='chkMargem' checked='true' class='chk form-control'><label for='chkMargem'>&nbsp;</label>
                    </div>
                    <div class='col-xs-1 '>
                        <label class='control-label'>Preto/Branco</label>
                        <input type='checkbox' id='chkSemCor' name='chkSemCor' checked='true' class='chk form-control'><label for='chkSemCor'>&nbsp;</label>
                    </div>
                </div>
            </div>
            <div class='groupBotoes'>
                <input type='submit' id='btnImprimir' name='btnImprimir' class='btn btn-lg btn-default' disabled='disabled' value='Imprimir'/>
                <input type='button' id='btnCancelar' name='btnCancelar' class='btn btn-lg btn-default' value='Cancelar'/>
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
    var spamOk = '<spam class=\'glyphicon glyphicon-ok\'></spam>';

    $('#cpfcnpj').focus();
    
    // Arruma o conflito nos botões do JQuery UI para estilizar os radio Buttons
    if($.fn.button.noConflict){
        $.fn.btn = $.fn.button.noConflict();
    };
    
    // Inicia o grupo dos radios com o JQueryUI
    $('#rdGroup').buttonset();
    $('.chk').button();
       
    // Inicia os botões para a classe jqbutton
    $('.jqbutton').button();
    
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
    
    $('#responsavel').load('<?php echo base_url('ImpProjetoCliente/carregarResponsavel?') ?>', function(){
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
        
    // Função Responsável por desabilitar os botões
    function desabilitaBotoes(){
        $('#btnImprimir').attr('disabled', 'disabled');
    };

    $('#chkTodos').change(function(){
        $(this).button('option',{
           label: this.checked ? 'Desmarcar Todos' : 'Selecionar Todos'
        });
        $('.chkOpt').prop('checked', this.checked);  
               $('.chkOpt').button('option', { 
            label: this.checked ? spamOk : '&nbsp;'
        });
       $('.chkOpt').button('refresh');
    });

    $('.chkOpt').change(function(){
        $(this).button('option', { 
            label: this.checked ? spamOk : '&nbsp;'
        });
    });
    
    $('#chkMargem,#chkSemCor,.chkOpt').button('option',{ 
        label: spamOk 
    });
    
    $('#chkMargem,#chkSemCor').change(function(){
        $(this).button('option', { 
            label: this.checked ? spamOk : '&nbsp;'
        });
    });

    // Função Responsável pela Validação do Formulário
    $('#btnFechar').click(function(){
        $('#janelaPrincipal').dialog('close');
    });
    
    $('#btnCancelar').click(function(){
        limparForm();
    });
    
    function limparForm(){
        $('#frmImpProjetoCliente').resetForm();
        $('.chk').change();
        $('#cpfcnpj').focus();
        $('input[type=radio][name=rdTipoCliente]').change();
        desabilitaBotoes();
        cpfcnpjAnterior = '';
    };
    
    var cpfcnpjAnterior = '';
    function cpfcnpjBlur(){
        if(cpfcnpjAnterior !== $('#cpfcnpj').val().replace(/[^\d]+/g,'') && !($('#rdCNPJ').is(':checked') && $('#cpfcnpj').val().replace(/[^\d]+/g,'').length < 14) ){           
            if(validarCPFCNPJ($('#cpfcnpj').val())){
                $.post('<?php echo base_url('ImpProjetoCliente/buscaRegistro') ?>',{
                    cpfcnpj : $('#cpfcnpj').val()
                }, function(data){
                    if(data.msg == ''){
                        $('#nome').val(data.nome);
                        (data.btnImprimir !== true) ? $('#btnImprimir').attr('disabled', 'disabled') : $('#btnImprimir').removeAttr('disabled');
                    }else{
                        $('#msgAlerta').html(data.msg);
                        $('#alertMessage').dialog('open');                        
                    }
                },'json');
            }else{
                $('#msgAlerta').html('CPF ou CNPJ Inválido');
                $('#alertMessage').dialog('open');
                desabilitaBotoes();
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
    
    // Muda a tela de login de acordo com o dispositivo acessado
    if((screen.width)<=630){
        $('#janelaPrincipal').dialog({
            dialogClass: 'no-close',
            width: '100%',
            height: '385',
            modal: true
        }); 
    }else if((screen.width)<=705){
        $('#janelaPrincipal').dialog({
            dialogClass: 'no-close',
            width: '90%',
            height: '385',
            modal: true
        });   
    }else if((screen.width)<=805){
        $('#janelaPrincipal').dialog({
            dialogClass: 'no-close',
            width: '80%',
            height: '385',
            modal: true
        });   
    }else if((screen.width)<=945){
        $('#janelaPrincipal').dialog({
            dialogClass: 'no-close',
            width: '70%',
            height: '385',
            modal: true
        });    
    }else if((screen.width)<=1135){
        // Janela Principal da Tela
        $('#janelaPrincipal').dialog({
            dialogClass: 'no-close',
            width: '60%',
            height: '385',
            modal: true
        });
    }else{
        // Janela Principal da Tela
        $('#janelaPrincipal').dialog({
            dialogClass: 'no-close',
            width: '50%',
            height: '385',
            modal: true
        });
    }
});
</script>