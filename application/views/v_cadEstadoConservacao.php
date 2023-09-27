<div id='janelaPrincipal' title='Cadastro de Estado de Conservação' style='display: none'>
    <div class='form-dialog-ui'>
        <form id='frmCadEstadoConservacao' method='post'>
            <div class='form-group' >
                <div class='row'>
                    <div class='col-xs-3'>
                        <label class='control-label'>ID</label>
                        <input type='text' class='form-control' id='id' name='id' placeholder='Apenas Números'/>
                    </div>
                    <div class='col-xs-9'>
                        <label class='control-label'>*Descrição</label>
                        <input type='text' class='form-control' id='nome' name='nome' placeholder='Descrição'/>
                    </div>
                </div>
            </div>
            <div id='gridEstadoConservacao'></div>
            <div class="groupBotoes">
                <input type='button' id='btnIncluir' name='btnIncluir' class='btn btn-lg btn-default' disabled='disabled' value='Incluir'/>
                <input type='button' id='btnAlterar' name='btnAlterar' class='btn btn-lg btn-default' disabled='disabled' value='Alterar'/>
                <input type='button' id='btnExcluir' name='btnExcluir' class='btn btn-lg btn-default' disabled='disabled' value='Excluir'/>
                <input type='button' id='btnLimpar' name='btnLimpar' class='btn btn-lg btn-default' value='Limpar'/>
                <input type='button' id='btnFechar' name='btnFechar' class='btn btn-lg btn-default' value='Fechar'/>
            </div>
        </form>
    </div>
</div>
<script>
$(function(){
    // Janela Principal da Tela
    $('#janelaPrincipal').dialog({
        dialogClass: 'no-close',
        width: '60%',
        height: '420',
        modal: true
    });
    $('#id').focus();
    
    // Função que permite que apenas numeros sejam digitados
    $('#id').bind('keydown',onlyNumbers);
    
    // Função de Callback do Post do Formulario
    function showResponse(){
        gridLoad();
        limparForm();
    };
    
    // Função Responsável por desabilitar os botões
    function desabilitaBotoes(){
        $('#btnIncluir').attr('disabled', 'disabled');
        $('#btnAlterar').attr('disabled', 'disabled');
        $('#btnExcluir').attr('disabled', 'disabled');
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

    // Função responsável pelo carregamento do grid
    var $dgLocal = $('#gridEstadoConservacao');
    function gridLoad(){
        $dgLocal.datagrid({
            jsonStore: {
                url:' <?php echo base_url('CadEstadoConservacao/dadosGrid') ?>'
            },
            pagination: false,
            mapper:
            [
                {name: 'id',title: 'Código',width: 50,align: 'center'},
                {name: 'nome',title: 'Descrição',width: 50}
            ],     
            eventController: {
                onClickRow: function(tr) {
                    $('#id').val(tr.cells[0].innerHTML);
                    $('#id').focus();
                    idAnterior = null;
                    idBlur();
                }
            }    
        });
    };
    gridLoad();
    
    // Ação dos Botões
    $('#btnIncluir').click(function(){
        $('#frmCadEstadoConservacao').ajaxForm({
            clearForm: true,
            beforeSubmit: validaForm,
            success: showResponse,
            url: '<?php echo base_url('CadEstadoConservacao/incluir') ?>',
            type:'post'
        }); 
        $('#frmCadEstadoConservacao').submit();
    });
    
    $('#btnAlterar').click(function(){
        $('#frmCadEstadoConservacao').ajaxForm({
            clearForm: true,
            beforeSubmit: validaForm,
            success: showResponse,
            url: '<?php echo base_url('CadEstadoConservacao/alterar') ?>',
            type:'post'
        }); 
        $('#frmCadEstadoConservacao').submit();
    });
    
    $('#btnExcluir').click(function(){
        $('#frmCadEstadoConservacao').ajaxForm({
            clearForm: true,
            success: showResponse,
            url: '<?php echo base_url('CadEstadoConservacao/excluir') ?>',
            type:'post'
        }); 
        $('#frmCadEstadoConservacao').submit();
    });

    $('#btnFechar').click(function(){
        $('#janelaPrincipal').dialog('close');
    });
    
    $('#btnLimpar').click(function(){
        limparForm();
    });
    
    function limparForm(){
        $('#frmCadEstadoConservacao').resetForm();
        $('#id').focus();
        desabilitaBotoes();
        idAnterior = null;
    };    
    
    var idAnterior = null;
    function idBlur(){
        if(idAnterior !== $('#id').val()){
            $.post('<?php echo base_url('CadEstadoConservacao/buscaRegistro') ?>',{
                id : $('#id').val()
            }, function(data){
                $('#nome').val(data.nome);
                (data.btnIncluir !== true) ? $('#btnIncluir').attr('disabled', 'disabled') : $('#btnIncluir').removeAttr('disabled');
                (data.btnAlterar !== true) ? $('#btnAlterar').attr('disabled', 'disabled') : $('#btnAlterar').removeAttr('disabled');
                (data.btnExcluir !== true) ? $('#btnExcluir').attr('disabled', 'disabled') : $('#btnExcluir').removeAttr('disabled');
            },'json');
        }
        idAnterior = $('#id').val();
    };
    
    function idFocus(){
        idAnterior = $('#id').val();
    };

    $('#id').blur(idBlur);
    $('#id').focus(idFocus);
});
</script>