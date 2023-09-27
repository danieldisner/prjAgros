    <div id='janelaPrincipal' title='Importação de dados de Municípios' style='display: none'>
        <div class='form-dialog-ui'>
            <form id='frmImportMunicipios' method='post'>
            <div class='form-group' >
                <div class='row'>
                    <div class='col-xs-12'>
                        <label class='control-label'>*Arquivo</label>
                        <input type='file' class='form-control' id='arquivo' name='arquivo' accept='.csv' size='20'/>
                    </div>
                </div>
            </div>
            <div id='gridMunicipios'></div>
            <div class="groupBotoes">
                <input type='button' id='btnConfirmar' name='btnConfirmar' class='btn btn-lg btn-default' disabled="disabled" value='Confirmar'/>
                <input type='button' id='btnLimpar' name='btnLimpar' class='btn btn-lg btn-default' value='Limpar'/>
                <input type='button' id='btnFechar' name='btnFechar' class='btn btn-lg btn-default' value='Fechar'/>
            </div>
        </form>
    </div>
</div>
<script>
// Extensões de arquivos permitidos || Ex: new Array('.odt','.pdf','.doc');
var extensoes = new Array('.csv');

$(function(){
    // Janela Principal da Tela
    $('#janelaPrincipal').dialog({
        dialogClass: 'no-close',
        width: '60%',
        height: '420',
        modal: true
    });
    
    // Evento mudar o valor do Arquivo
    $('#arquivo').change(function(){
        if($('#arquivo').val()){
            habilitaBotoes();
        }else{
           desabilitaBotoes(); 
        }
    });
    
    // Função de Callback do Post do Formulario
    function showResponse(){
        gridLoad();
        limparForm();
    };
    
    // Função Responsável por habilitar os botões
    function habilitaBotoes(){
        $('#btnConfirmar').removeAttr('disabled');
    };
    
    // Função Responsável por desabilitar os botões
    function desabilitaBotoes(){
        $('#btnConfirmar').attr('disabled', 'disabled');
    };
    
    // Função Responsável pela Validação do Formulário
    function validaForm(){       
        // Verifica a extensão do arquivo
        if(!validaExtensaoArquivo($('#arquivo').val(),extensoes)){
            $('#msgAlerta').html('Extensão do arquivo inválida.');
            $('#alertMessage').dialog("open");
            return false;
        }
    };

    // Função responsável pelo carregamento do grid
    var $dgLocal = $('#gridMunicipios');
    function gridLoad(){
        $dgLocal.datagrid({
            jsonStore: {
                url:' <?php echo base_url('ImportMunicipios/dadosGrid') ?>'
            },
            pagination: false,
            mapper:
            [
                {name: 'id',title: 'Código',width: 50,align: 'center'},
                {name: 'nome',title: 'Descrição',width: 50}
            ]
        });
    };
    gridLoad();
    
    // Ação dos Botões
    $('#btnConfirmar').click(function(){
        $('#frmImportMunicipios').ajaxForm({
            clearForm: true,
            beforeSubmit: validaForm,
            success: showResponse,
            url: '<?php echo base_url('ImportMunicipios/enviarArquivo') ?>',
            type:'post'
        }); 
        $('#frmImportMunicipios').submit();
    });

    $('#btnFechar').click(function(){
        $('#janelaPrincipal').dialog('close');
    });
    
    $('#btnLimpar').click(function(){
        limparForm();
    });
    
    function limparForm(){
        $('#frmImportMunicipios').resetForm();
        desabilitaBotoes();
    };
});
</script>