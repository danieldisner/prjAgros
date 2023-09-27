<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Agros - Sistema</title>
    <link rel='icon' href='<?php echo base_url('includes/images/favicon.ico'); ?>' type='image/ico'/>

    <!-- Bootstrap -->
    <link href='<?php echo base_url('includes/bootstrap/css/bootstrap.min.css');?>' rel='stylesheet'>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script type='text/javascript' src='<?php echo base_url('includes/js/disner.js')?>'></script>
    <script type='text/javascript' src='<?php echo base_url('includes/js/jquery.js')?>'></script>
    <script type='text/javascript' src='<?php echo base_url('includes/js/jquery-ui.min.js')?>'></script>
    <script type='text/javascript' src='<?php echo base_url('includes/js/jquery_forms.js')?>'></script>

    <link rel='stylesheet' href='<?php echo base_url('includes/js/jquery-ui.min.css')?>' media='all'/>
    <link rel='stylesheet' href='<?php echo base_url('includes/js/jquery-ui.structure.min.css')?>' media='all'/>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src='<?php echo base_url('includes/bootstrap/js/bootstrap.min.js');?>'></script>
    
    <!-- Css da página de login -->
    <link href='<?php echo base_url('includes/css/login.css');?>' rel='stylesheet'>
</head>
<body>
<div id='notify'>
    <?php
        $mensagem = $this->session->flashdata('mensagem');
    ?>
    <div id='login-status' class='alert alert-danger' style='visibility: hidden; opacity: 0;'>
        <div id='login-status-message'>&nbsp;</div>
    </div>
</div>
<div id='container' >
    <div id='login-panel'>
        <div id='imagem'>
            <img class='logo' src='<?php echo base_url('includes/images/logo.jpg')?>' alt='logo'>
        </div>
        <div id='tabs'>
            <form role='form' id='frmRedefinirSenha' name='frmRedefinirSenha' method='post' action='<?php echo base_url('login/logar') ?>'>
                <input type='hidden' id='usuario' name='usuario' value='<?php echo $usuario;?>'/>
                <div class='form-group'>
                    <h5>Redefinir Senha</h5>
                    <div class='inner-addon left-addon'>
                        <i class='glyphicon glyphicon-lock'></i>      
                        <input type='password' name='senhacadastro1' id='senhacadastro1' class='form-control required' placeholder='Senha de Acesso'>
                    </div>
                    <div class='inner-addon left-addon'>
                        <i class='glyphicon glyphicon-lock'></i>      
                        <input type='password' name='senhacadastro2' id='senhacadastro2' class='form-control required' placeholder='Redigitar a Senha'>
                    </div>
                    <button type='button' id='btnSubmit' name='btnSubmit' disabled='disabeled' class='form-control jqbutton'> <i class='glyphicon glyphicon-ok'> </i> Redefinir Senha </button>
                </div>
            </form>
        </div>
    </div>
</div>    
</div>
<div id='alertMessage' title='Atenção' style='display: none'>
    <span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0;'></span><p align='center' id='msgAlerta'></p>
</div>
</body>
</html>
<script>
$(function(){    
    // Alerta Modal estilizado
    $('#alertMessage').dialog({
        dialogClass: 'no-close',
        resizable: false,
        modal: true,
        width: '20%',
        autoOpen: false,
        buttons: {
            'OK': function(){
                $(this).dialog('close');
                window.location.replace('<?php echo base_url('Login')?>');
            }
        }
    });
    
    var spamAlert = '<span class=\'glyphicon glyphicon-alert\'></span>&nbsp;';
    // Abas
    $('#tabs').tabs({
        heightStyle: 'content'
    });

    // Arruma o conflito nos botões do JQuery UI para estilizar os radio Buttons
    if($.fn.button.noConflict){
        $.fn.btn = $.fn.button.noConflict();
    };
    // Inicia os botões para a classe jqbutton
    $('.jqbutton').button();
    
    <?php if (!empty($mensagem)){ ?>
        $('#login-status-message').html(spamAlert+'<?php echo $mensagem;?>');
        $('#login-status').css('visibility','visible');
        $('#login-status').css('opacity','1');
    <?php } ?>

    // Muda a tela de login de acordo com o dispositivo acessado
    if((screen.width)<245){
        $('#container').width('100%');
    }else if((screen.width)<400){
        $('#container').width('90%');
    }else if((screen.width)<=680){
        $('#container').width('80%');
    }else if((screen.width)<=780){
        $('#container').width('60%');
    }else if((screen.width)<=1024){
        $('#container').width('40%');
    }
    
    // Função de Callback do Post do Formulario
    function showResponse(response){        
        $('#msgAlerta').html(response.msg);
        $('#alertMessage').dialog('open');
    };
    
    // Valida o formulário
    function validaForm(){
        var result = true;        
        // Verifica item a item do formulário
        if($('#senhacadastro1').val() != $('#senhacadastro2').val()){
            $('#msgAlerta').html('Senhas não combinam.');
            $('#alertMessage').dialog('open');    
            result = false;
        }        
        return result;
    };
    
    $('#btnSubmit').click(function(){
        $('#frmRedefinirSenha').ajaxForm({
            clearForm: true,
            beforeSubmit: validaForm,
            success: showResponse,
            url: '<?php echo base_url('redefinirSenha/redefinir') ?>',
            type:'post',
            dataType : 'json'
        });
        $('#frmRedefinirSenha').submit();
    });
       
    /*
    * Botar validação no onkeypress até a senha digitada ser valida e no caso da "senha2" até coincidir com a "senha1"
    */
    var senhaValida = false;
    var validacaoSenha1 = false;
    var validacaoSenha2 = false;
    function keyUpSenha(){
        senhaValida = true;
        if($(this).val().length < 6){
            senhaValida = false;
        }
        if((senhaValida) && $(this).prop('id') == 'senhacadastro1'){
            validacaoSenha1 = true;
        }
        if($(this).prop('id') == 'senhacadastro2'){
            if($(this).val()  !== $('#senhacadastro1').val()){
                senhaValida = false;
            }else{
                validacaoSenha2 = true;
            }
        }
        if(senhaValida){
            // Verde
            $(this).css('background-color','#98FB98');                
        }else{
            // Vermelho
            $(this).css('background-color','#FFB7B7');
        }
        saidaSenhas();
    };
    $('#senhacadastro1').keyup(keyUpSenha);
    $('#senhacadastro2').keyup(keyUpSenha);
    
    function saidaSenhas(){
        if(senhaValida && validacaoSenha1 && validacaoSenha2)
            $('#btnSubmit').button('option', 'disabled', false );
    };
});
</script>