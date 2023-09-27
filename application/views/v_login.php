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
        <div id='tabs' style='height: 290px'>
            <ul>
                <li><a href='#abaLogin'>Login</a></li>
                <li><a href='#abaRegistro'>Registrar-se</a></li>
            </ul>
            <div id='abaLogin'>
                <form role='form' id='frmLogin' name='frmLogin' method='post' action='<?php echo base_url('login/logar') ?>'>
                    <div class='form-group'>
                        <label for='usuario'>Usuário</label>
                        <div class='inner-addon left-addon'>
                            <i class='glyphicon glyphicon-user'></i>      
                            <input type='text' name='usuario' id='usuario' class='form-control' placeholder='Usuário/E-mail'>
                        </div>
                        <label for='senha'>Senha</label>
                        <div class='inner-addon left-addon'>
                            <i class='glyphicon glyphicon-lock'></i>      
                            <input type='password' name='senha' id='senha' class='form-control' placeholder='Senha de Acesso'>
                        </div>
                        <button id='btnEntrar' name='btnEntrar' type='submit' value='Entrar' class='form-control jqbutton'> <i class='glyphicon glyphicon-ok'> </i> EFETUAR LOGIN</button>
                        <span style='float: right; padding-top: 10px'><a href='<?php echo base_url('recuperarSenha') ?>'>Esqueci a senha</a></span>
                    </div>
                </form>
            </div>
            <div id='abaRegistro'>
                <form role='form' id='frmCadastrar' name='frmCadastrar' method='post' action='<?php echo base_url('login/logar') ?>'>
                    <div class='form-group'>
                        <div class='inner-addon left-addon'>
                            <i class='glyphicon glyphicon-exclamation-sign'></i>      
                            <input type='text' name='nomecadastro' id='nomecadastro' class='form-control required' placeholder='Nome Completo'>
                        </div>
                        <div class='inner-addon left-addon'>
                            <i class='glyphicon glyphicon-envelope'></i>      
                            <input type='email' name='emailcadastro' id='emailcadastro' class='form-control required' placeholder='E-mail'>
                        </div>
                        <div class='inner-addon left-addon'>
                            <i class='glyphicon glyphicon-user'></i>      
                            <input type='text' name='usuariocadastro' id='usuariocadastro' class='form-control required' placeholder='Usuário'>
                        </div>
                        <div class='inner-addon left-addon'>
                            <i class='glyphicon glyphicon-lock'></i>      
                            <input type='password' name='senhacadastro1' id='senhacadastro1' class='form-control required' placeholder='Senha de Acesso'>
                        </div>
                        <div class='inner-addon left-addon'>
                            <i class='glyphicon glyphicon-lock'></i>      
                            <input type='password' name='senhacadastro2' id='senhacadastro2' class='form-control required' placeholder='Redigitar a Senha'>
                        </div>
                        <button type='button' id='btnCadastrar' name='btnCadastrar' value='cadastrar' class='form-control jqbutton' disabled="disabled"> <i class='glyphicon glyphicon-ok'> </i> REGISTRAR-SE </button>
                    </div>
                </form>
            </div>
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
            }
        }
    });
    
    // Variáveis de controle
    var senhaValida = false;
    
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
        if(response.error == false){
            $('#btnCadastrar').button('option','disabled',true);
            $('#tabs').tabs('option','active',0);
        }
    };
    
    // Valida o formulário
    function validaForm(){
        var result = true;        
        // Verifica item a item do formulário
        if(!validarEmail($('#emailcadastro').val())){
            $('#msgAlerta').html('Email Inválido.');
            $('#alertMessage').dialog('open');   
            resul = false;
        }else if(!validarCamposDiv('#abaRegistro')){
            $('#msgAlerta').html('Campos obrigatórios não preenchidos.');
            $('#alertMessage').dialog('open');
            result = false; 
        }else if($('#senhacadastro1').val() != $('#senhacadastro2').val()){
            $('#msgAlerta').html('Senhas não combinam.');
            $('#alertMessage').dialog('open');    
            result = false;
        }        
        return result;
    };
    
    var validacaoSenha1 = false;
    var validacaoSenha2 = false;
    var validacaoUsuario = false;
    var validacaoEmail = false;
    var validacaoNome = false;
    
    $('#btnCadastrar').click(function(){
        $('#frmCadastrar').ajaxForm({
            clearForm: true,
            beforeSubmit: validaForm,
            success: showResponse,
            url: '<?php echo base_url('login/registrarUsuario') ?>',
            type:'post',
            dataType : 'json'
        });
        // Busca o usuário e o email para verificação e só envia o formulário
        // Se não retornar mensagem (erro)
        $.post('<?php echo base_url('Login/checkEmail') ?>',{
            emailcadastro : $('#emailcadastro').val(),
            usuariocadastro : $('#usuariocadastro').val()
        }, function(data){ 
            if(data.msg !== ''){
                $('#msgAlerta').html(data.msg);
                $('#alertMessage').dialog('open');  
                result = false;
            }else{
                $('#frmCadastrar').submit();
                    // Desabilita o botão
                    $('#btnCadastrar').button('option','disabled',true);
            }
        },'json');
        // Seta para false as variáveis de controle
        validacaoSenha1 = false;
        validacaoSenha2 = false;
        validacaoUsuario = false;
        validacaoEmail = false;
        validacaoNome = false;
    });
    
    // Validações
    function keyUpCamposUsuario(){
        if($(this).val().trim() == ''){
            // Vermelho
            $(this).css('background-color','#FFB7B7');
        }else{
            if($(this).prop('id') == 'usuariocadastro'){
                validacaoUsuario = true;
            }else{
                validacaoNome = true;
            }  
            // Verde
            $(this).css('background-color','#98FB98');
        }
    }
    $('#usuariocadastro').keyup(keyUpCamposUsuario);
    $('#nomecadastro').keyup(keyUpCamposUsuario);
    
    function keyUpEmail(){
        if(!validarEmail($('#emailcadastro').val())){
            // Vermelho
            $(this).css('background-color','#FFB7B7');
        }else{
            // Verde
            $(this).css('background-color','#98FB98');
            validacaoEmail = true;
        }
    }
    $('#emailcadastro').keyup(keyUpEmail);
    
    /*
    * Botar validação no onkeypress até a senha digitada ser valida e no caso da "senha2" até coincidir com a "senha1"
    */    
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
        saidaCamposCadastro();
    };
    $('#senhacadastro1').keyup(keyUpSenha);
    $('#senhacadastro2').keyup(keyUpSenha);
    
    function saidaCamposCadastro(){
        if(validacaoSenha1 && validacaoSenha2 && validacaoUsuario && validacaoEmail && validacaoNome)
            $('#btnCadastrar').button('option', 'disabled', false );
    };
    
    $('#usuariocadastro').blur(saidaCamposCadastro);
    $('#nomecadastro').blur(saidaCamposCadastro);
    $('#emailcadastro').blur(saidaCamposCadastro);
    $('#senhacadastro1').blur(saidaCamposCadastro);
    $('#senhacadastro2').blur(saidaCamposCadastro);
    
    // Botão que verifica qual tecla foi pressionada
    $(document).keypress(function(e){
        // Pega qual das abas está ativa
        var active = $('#tabs').tabs('option','active');
        // Se pressionou enter
        if(e.which == 13){
            if(active == 0)
                $('#btnEntrar').click();
            else $('#btnCadastrar').click();
        }
    });    
});
</script>