<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>AGROS - Sistema</title>
    <link rel='icon' href='<?php echo base_url('includes/images/favicon.ico'); ?>' type='image/ico'/>

    <!-- Bootstrap -->
    <link href='<?php echo base_url('includes/bootstrap/css/bootstrap.min.css');?>' rel='stylesheet'>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script type='text/javascript' src='<?php echo base_url('includes/js/disner.js')?>'></script>
    <script type='text/javascript' src='<?php echo base_url('includes/js/jquery.js')?>'></script>
    <script type='text/javascript' src='<?php echo base_url('includes/js/jquery_forms.js')?>'></script>
    <script type='text/javascript' src='<?php echo base_url('includes/js/jquery-ui.min.js')?>'></script>
    <script type='text/javascript' src='<?php echo base_url('includes/js/datepicker-pt-BR.js')?>'></script>
    <script type='text/javascript' src='<?php echo base_url('includes/js/jquery-ui.datagrid.min.js')?>'></script>
    <script type='text/javascript' src='<?php echo base_url('includes/js/jquery.maskedinput.js')?>'></script>
    <link rel='stylesheet' href='<?php echo base_url('includes/js/jquery-ui.min.css')?>' media='all'/>
    <link rel='stylesheet' href='<?php echo base_url('includes/js/jquery-ui.structure.min.css')?>' media='all'/>
    <link rel='stylesheet' href='<?php echo base_url('includes/js/jquery-ui.datagrid.css')?>' media='all'/>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src='<?php echo base_url('includes/bootstrap/js/bootstrap.min.js');?>'></script>

    <style type='text/css'>
    .no-close .ui-dialog-titlebar-close {display: none;}
    legend.scheduler-border{
        width:inherit; /* Or auto */
        padding:0 10px; /* To give a bit of padding on the left and right */
        border-bottom:none;
    }
    .input-group{
        padding-bottom:10px;
    }
    .form-dialog-ui{
       padding-left: 5px; 
       padding-right: 5px; 
    }
    .control-label{
        font-size: 11px;
        color: #696969; 
    }
    label{
        max-width: 100%;
        margin-bottom: 2px;
        margin-left: 3.5px;
    }
    .form-control{
        margin-bottom: 5px;
        padding-left: 2px;
        padding-right: 0px;
      
    }
    .form-group{
        margin-left: 10px;
        margin-right: 10px;
    }
    .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
        position: relative;
        min-height: 1px;
        padding-right: 5px;
        padding-left: 5px;
    }
    .groupBotoes{
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 3px;
        border-width: 1px;
        display: -webkit-flex;
        display: flex;
        -webkit-align-items: center;
        align-items: center;
        -webkit-justify-content: center;
        justify-content: center;
        margin-top: 5px;
    }
    .ui-accordion .ui-accordion-content{
        padding: 0.3em 0.2em;
        border-top: 0;
        overflow: auto;
    }
    .groupAccordion{
        width: 100%;
        border: 1px solid #ddd;
        border-radius: 3px;
        border-width: 1px;
        overflow: auto;
    }
    .ui-widget input, .ui-widget select, .ui-widget textarea, .ui-widget button{
        font-family: Arial,Helvetica,sans-serif;
        font-size: 0.9em;
    }
    .ui-dialog .ui-dialog-content{
        position: relative;
        border: 0;
        padding: .3em 0.1em;
        background: none;
        overflow: auto;
    }
    #alertMessage{
        display: -webkit-flex;
        display: flex;
        -webkit-align-items: center;
        align-items: center;
        -webkit-justify-content: center;
        justify-content: center;
        margin-top: 5px;
    }
    body{
        background-color: #D3D3D3;
    }
    .table-header{
        background-color: #6c8c9c;
    }
    .table-sub-header{
       background-color: #bacdd6;
    }
    .table-exploracao{
        margin-bottom: 1px;
    }
    .input-cell-content{
        height: 25px;
        text-align-last: center;
        text-align: center;
        -ms-text-align-last: center;
        -moz-text-align-last: center;
        text-align-last: center;
    }
    .input-cell-content[readonly]{
        background-color:#e5ebeb;
    }
    .select-no-style{
        -webkit-appearance: none;
        background-color: white;
    }
    .select-table-header{
        -webkit-appearance: none;
        background-color: #bacdd6;
        border: none;
    }
   .navbar-inverse {
        font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
        font-size: 14px;
        color: #333;
        background-color: #1B3340;
    }
    .navbar-inverse .navbar-nav>.open>a, .navbar-inverse .navbar-nav>.open>a:focus, .navbar-inverse .navbar-nav>.open>a:hover {
        color: #fff;
        background-color: #062333;
    }
    .navbar-inverse{
        border-color: #1B3340;
    }
    
    </style>
    <!-- Carrega funções Jquery que são Bastante Usadas -->
    <script>
    $(function(){
        // Date picker em português
        $('.datepicker').datepicker($.datepicker.regional['pt-BR']);
        $('.datepicker').mask('99/99/9999');

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
        
        // Máscara Telefone
        $('input.telefone').mask('(99) 9999-9999?9').focusout(function(event){  
            var target, phone, element;  
            target = (event.currentTarget) ? event.currentTarget : event.srcElement;  
            phone = target.value.replace(/\D/g, '');
            element = $(target);  
            element.unmask();  
            if(phone.length > 10){  
                element.mask('(99) 99999-999?9');  
            }else{  
                element.mask('(99) 9999-9999?9');  
            }
        });

        $('.required').blur(function(){
            if($(this).val().replace(/[\._-]/g,'') !== ''){
                $(this).css('background-color','#fff');
            }
        });
       
        // Máscaras: CPF,CNPJ,CEP,RG
        $('.cpf').mask('999.999.999-99');
        $('.cnpj').mask('99.999.999/9999-99');
        $('.cep').mask('99999-999');

        // Formata os campos decimais
        $('.decimal').attr('autocomplete','off');
        $('.decimal').blur(function(){
            if($(this).val() !== '')
                $(this).val(blurNumeric($(this).val().split('.').join('')));
        });
        $('.decimal4').blur(function(){
            if($(this).val() !== '')
                $(this).val(blurNumeric($(this).val().split('.').join(''), 4));
        });
        $('.decimal').bind('keydown',onlyNumbersAndComma);
        
        // Função que permite que apenas numeros sejam digitados
        $('.onlynumbers').bind('keydown',onlyNumbers);
    }); 
    </script>
</head>
<body style='background-color: #D3D3D3'>
<nav class='navbar navbar-inverse'>
    <header class='container-fluid'>
        <div class='navbar-header'>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class='navbar-brand' href='<?php echo base_url();?>'></span>Agros</a>
        </div>
        <div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>
        <ul class='nav navbar-nav'>
        <?php foreach($menus as $menu1){
            if(empty($menu1['categoria'])){?>
               <li class='dropdown'>
                <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'><?php echo $menu1['caption'];?> <span class='caret'></span></a>
                <ul class='dropdown-menu'>
                <?php  
                    foreach($menus as $menu2){
                        if($menu2['categoria']==$menu1['nome']){
                        ?>
                        <li><a href='<?php echo base_url($menu2['nome']);?>'><?php echo $menu2['caption'];?> </a></li>  
                        <?php
                        }
                    }
                ?>                    
                </ul>
              </li>
              <?php
            }
        }?>
        </ul>
        <ul class='nav navbar-nav navbar-right'>
           <li><a href='<?php echo base_url('Login/sair');?>'><span class='glyphicon glyphicon-off'></span> Sair</a></li>
        </ul>
        </div>    
    </header>
    </div>
    </nav>
    <div id='alertMessage' title='Atenção' style='display: none'>
        <span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0;'></span><p align='center' id='msgAlerta'></p>
    </div>