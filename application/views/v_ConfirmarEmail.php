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
    <div id='login-status' class='alert alert-danger' style='visibility: hidden; opacity: 0;'>
        <div id='login-status-message'>&nbsp;</div>
    </div>
</div>
<div id='container' >
    <div id='login-panel' style="background-color: #e7e7e7">
        <div id='imagem'>
            <img class='logo' src='<?php echo base_url('includes/images/logo.jpg')?>' alt='logo'>
        </div>
        <div style="align-items: center;">
            <p style="margin: 5%;">
                <strong>
                <?php echo $mensagem; ?>
                </strong>
            </p>
        </div>
    </div>
</div>    
</div>

</body>
</html>
<script>
$(function(){    
 
});
</script>