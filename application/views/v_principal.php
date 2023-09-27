<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Agros Assessoria</title>
    <link rel='icon' href='<?php echo base_url('includes/images/favicon.ico'); ?>' type='image/ico'/>

    <!-- Bootstrap -->
    <link href='<?php echo base_url('includes/bootstrap/css/bootstrap.min.css');?>' rel='stylesheet'>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script type='text/javascript' src='<?php echo base_url('includes/js/jquery.js')?>'></script>
    <script type='text/javascript' src='<?php echo base_url('includes/js/jquery.easing.min.js')?>'></script>
    <script type='text/javascript' src='<?php echo base_url('includes/js/scrolling-nav.js')?>'></script>

    <!-- bxSlider Javascript file -->
    <script type='text/javascript' src='<?php echo base_url('includes/slider/jquery.bxslider.min.js')?>'></script>

    <!-- bxSlider CSS file -->
    <link href='<?php echo base_url('includes/slider/jquery.bxslider.css')?>' rel='stylesheet' />
    <link href='<?php echo base_url('includes/css/animate.css')?>' rel='stylesheet' />

        
    <!-- Scrolling Nav JavaScript -->
    <script type='text/javascript' src='<?php echo base_url('includes/js/jquery_forms.js')?>'></script>


    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src='<?php echo base_url('includes/bootstrap/js/bootstrap.min.js');?>'></script>
    
    <!-- Css da página de login -->
    <link href='<?php echo base_url('includes/css/scrolling-nav.css');?>' rel='stylesheet'>
    <link href='<?php echo base_url('includes/css/login.css');?>' rel='stylesheet'>

</head>

<style type='text/css'>
    .no-close .ui-dialog-titlebar-close {display: none;}
    body{
        background: #160959;
    }
   .navbar-inverse {
        font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;
        font-size: 17px;
        color: #eef0fc;
        background-color: #160959;
    }
    .navbar-inverse .navbar-nav>.open>a, .navbar-inverse .navbar-nav>.open>a:focus, .navbar-inverse .navbar-nav>.open>a:hover {
        color: #fff;
        background-color: #062333;
    }
    .navbar-inverse{
        border-color: #eef0fc;
    }
    .navbar-inverse .navbar-nav>.active>a, .navbar-inverse .navbar-nav>.active>a:focus, .navbar-inverse .navbar-nav>.active>a:hover {
        color: #fff;
        background-color: #260ea0;
    }    
    .contact-section {
        height: 100%;
        padding-top: 15px;
        text-align: center;
        background: #160959;
    }
    .intro-section {
        height: auto;
        padding-top: 100px;
        padding-bottom: 50px;
        text-align: center;
        background: #f2f2f2;
    }
    .intro-section h2,h3,h4,label{
        font-family: sans-serif;
        padding: 10px;
        color: #160959;
    }
    .about-section h1,h2,h3,h4,label{
        color: #B6D1F2;
        padding: 10px;
    }
    .about-section{
        height: auto;
        padding-top: 25px;
        padding-bottom: 50px;
        text-align: center;
        background: #160959;
    }
    .about-section p {
        color: #B6D1F2;
        padding: 10px;
        font-size: 18px;
    }
    .services-section{
        height: auto;
        padding-top: 25px;
        padding-bottom: 10px;
        text-align: center;
        background: #f2f2f2;
    }
    .services-section h1,.services-section h2, .services-section p,.services-section  h3,h4,label{
        font-family: sans-serif;
        padding: 10px;
        color: #41464c;
    }
    .contact-section h1,h2,h3,h4,label{
        color: #B6D1F2;
        padding: 10px;
    }
    .contact-section p {
        color: #B6D1F2;
        padding: 10px;
        font-size: 18px;
    }
    .contact-icons{
        height: auto;
        padding-top: 50px;
        border-top: #B6D1F2 solid;
        background: #160959;
    }
    .container-services{
        margin-bottom: 10px;
    }
    .container-contact{
        background: #160959;
        padding-bottom: 15px;
    }
    .row-contact{
        padding-bottom: 10px;
    }
    label{
        float: left;
    }
    .navbar-default {
        background-color: #37344c;
        border-color: #e7e7e7;
    }
    .btn-info {
        width: 97%;
        color: #fff;
        background-color: #260ea0;
        border-color: #260ea0;
        border-style: solid;
    }

    .imagemLogo{
        height: 100%;
    }
    .colsis{
        border: #234457 solid;
        border-radius: 3px;
        align-items: center;
    }
    .groupCarousel{
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 3px;
        border-width: 1px;
        -webkit-align-items: center;
        align-items: center;
        -webkit-justify-content: center;
        justify-content: center;
        margin-top: 5px;
    }
    .modal-dialog{
        width: 80%;
        height: 80%
    }
    .footer {
        clear: both;
        position: relative;
        z-index: 10;
        height: auto;
        margin-top: -3em;
        width: 100%;
        background-color: #160959;
    }
    .container .text-muted {
        margin: 5px 0;
                -webkit-align-items: center;
        align-items: center;
        -webkit-justify-content: center;
        justify-content: center;
    }
    .text-muted {
        color: #777;
    }
    .imgCarousel{
        height: 200px;
    }
    .subTituloCarousel{
        height: 80px;
    }
</style>
<!-- The #page-top ID is part of the scrolling feature - the data-spy and data-target are part of the built-in Bootstrap scrollspy function -->

<body id='page-top' data-spy='scroll' data-target='.navbar-fixed-top'>

    <!-- Navigation -->
    <nav class='navbar navbar-inverse navbar-fixed-top' role='navigation'>
        <div class='container'>
            <div class='navbar-header page-scroll'>
                <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-ex1-collapse'>
                    <span class='sr-only'>Toggle navigation</span>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                </button>
                <a class='navbar-brand page-scroll' href='#page-top'>Início</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class='collapse navbar-collapse navbar-ex1-collapse'>
                <ul class='nav navbar-nav'>
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class='hidden'>
                        <a class='page-scroll' href='#page-top'></a>
                    </li>
                    <li>
                        <a class='page-scroll' href='#about'>Sobre</a>
                    </li>
                    <li>
                        <a class='page-scroll' href='#services'>Serviços</a>
                    </li>
                    <li>
                        <a class='page-scroll' href='#contact'>Contato</a>
                    </li>
                </ul>
                <ul class='nav navbar-nav navbar-right'>
                    <li><a href='<?php echo base_url('Login');?>'><span class='glyphicon glyphicon-hand-right'></span> Entrar no Sistema</a></li>
                 </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Intro Section -->
    <section id='intro' class='intro-section'>
        <div class='container'>
            <div class='row'>
                <div class='col-lg-12'>
                    <h2 class='animated fadeInRight'><strong>BEM VINDOS À </strong></h2>
                    <div class='logo' style='display: block;'>
                        <img class='imagemLogo animated fadeInLeft' src='<?php echo base_url('includes/images/logoAgros.png')?>' alt='AGROS'>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id='about' class='about-section'>
        <div class='container'>
            <div class='row'>
                <div class='col-lg-12'>
                    <h1 class='animated fadeInRight'><strong>Sobre</strong></h1>
                    <p class='animated fadeInLeft'>
                    Nosso trabalho consiste em atender e organizar suas necessidades. Agilizar processos com acesso de cada indivíduo aos dados anexados, permitindo o acompanhamento dos projetos em andamento e dados cadastrados.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id='services' class='services-section'>
        <div class='container container-services'>
            <div class='row'>
                <div class='col-lg-12'>
                    <h1 class='animated fadeInRight'><strong>Serviços</strong></h1>
                    <div class='col-lg-2'>
                    </div>
                    <div style='margin-right: 20px' class='col-lg-4 groupCarousel'>
                        <h3 class='subTituloCarousel'>Assessoria</h2>
                        <ul class='bxslider'>
                            <li><img class='imgCarousel' src='<?php echo base_url('includes/images/imgProjs01.jpg')?>'/></li>
                            <li><img class='imgCarousel' src='<?php echo base_url('includes/images/imgProjs02.jpg')?>'/></li>
                            <li><img class='imgCarousel' src='<?php echo base_url('includes/images/imgProjs03.jpg')?>'/></li>
                        </ul>
                        <p> Crédito e Ambiental.<br/><br/></p>
                    </div>
                    <div class='col-lg-4 groupCarousel'>
                        <h3 class='subTituloCarousel'>Sistema Web de Gestão de Processos de Agronegócios</h2>
                        <ul class='bxslider'>
                            <li><img class='imgCarousel' src='<?php echo base_url('includes/images/imgSis01.png')?>'/></li>
                            <li><img class='imgCarousel' src='<?php echo base_url('includes/images/imgSis02.png')?>'/></li>
                            <li><img class='imgCarousel' src='<?php echo base_url('includes/images/imgSis03.png')?>'/></li>
                            <li><img class='imgCarousel' src='<?php echo base_url('includes/images/imgSis04.png')?>'/></li>
                            <li><img class='imgCarousel' src='<?php echo base_url('includes/images/imgSis05.png')?>'/></li>
                        </ul>
                        <p> Controle automatizado dos Produtores, Propriedades e Produção Agropecuária.</p>
                    </div>
                    <div class='col-lg-2'>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id='contact' class='contact-section'>
        <div class='container container-contact' style='padding: 5px'>
            <div class='row row-contact'>
                <div class='col-lg-12'>
                    <h1 class='animated fadeInRight'>Contato</h1>
                    <div class='col-lg-6 col-sm-6'>
                        <h4>Entre em contato conosco.</h4>
                        <form id='frmContato' role='form' method='post'>
                            <div class='form-group'>
                                <label for='nome'>Nome</label>
                                <input type='text' id='nome' name='nome' class='form-control'>
                            </div>
                          <div class='form-group'>
                            <label for='email'>Email</label>
                            <input type='text' id='email' name='email' class='form-control'>
                          </div>
                          <div class='form-group'>
                            <label for='telefone'>Telefone</label>
                            <input type='text' id='telefone' name='telefone' class='form-control'>
                          </div>
                          <div class='form-group'>
                            <label for='mensagem'>Mensagem</label>
                            <textarea id='mensagem' name='mensagem' rows='5' class='form-control'></textarea>
                          </div>
                          <button class='btn btn-info' name='btnEnviaEmail' id='btnEnviaEmail' type='button'>Enviar</button>
                        </form>
                    </div>
                    <div class='col-lg-6 col-sm-6'>
                        <h4>Parceiros:</h4>
                        <div class='col-lg-6 col-sm-6'><img class='img-responsive' src='<?php echo base_url('includes/images/logoSicredi.png')?>'/> </div>
                    </div>
                </div>
            </div>
            <div class='row contact-icons'>
                <div  class='col-lg-4'>
                    <img class='img-circle animated zoomIn' src='<?php echo base_url('includes/images/local-ico.png')?>' alt='logo'>
                    <h2>ENDEREÇO</h2>
                    <p>Rua dos Cristais, 704. Jardim Maria Izabel <br/> Marília - São Paulo</p>
                </div>
                <div class='col-lg-4'>
                    <img class='img-circle animated zoomIn' src='<?php echo base_url('includes/images/clock-ico.png')?>' alt='logo'>
                    <h2>HORÁRIOS</h2>
                    <p>Segunda - Sexta 9h às 18h<br/> Sábado - 9h às 12h <br/> Domingo - Fechado </p>
                </div>
                <div class='col-lg-4'>
                    <img class='img-circle  animated zoomIn' src='<?php echo base_url('includes/images/phone-ico.png')?>' alt='logo'>
                    <h2>CONTATOS </h2>
                    <p>+055 (14) 3432-3557<br/>+055 (14) 9978-64001 </p>
                </div>
            </div>
        </div>
    </section>
    <!--
    <footer class="footer navbar-fixed-bottom">
        <div class="container" style="text-align: center;">
        <p class="text-muted">© Copyright 2012 - 2016. Todos os direitos reservados à Agros.</p>
      </div>
    </footer>
    !-->
    <div class='modal fade' id='modalImg' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
            <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
            </div>
            <div class='modal-body' style='height: auto;'>
                <img style='width: 100%;height: 100%;' id='mimg' src=''>
            </div>
            </div>
        </div>
    </div>
</body>
</html>
<script>
$(function(){
    $('.bxslider').bxSlider({
        mode: 'horizontal',
        auto: true,
        adaptiveHeight: false
    });
    
    $('.imgCarousel').on('click',function(){
        var sr=$(this).attr('src'); 
        $('#mimg').attr('src',sr);
        $('#modalImg').modal('show');
        $('.bx-prev').css('display','none');
        $('.bx-next').css('display','none');
    });
    
    $('#modalImg').on('hidden.bs.modal', function () {
        $('.bx-prev').css('display','block');
        $('.bx-next').css('display','block');
    });
    
    // Função Responsável pela Validação do Formulário
    function validaForm(){       
        // Verifica item a item do formulário
        if(!$('#nome').val().trim()){
            alert('O Nome não pode estar vazio.');
            return false; 
        }
        if(!$('#email').val().trim()){
            alert('O Email não pode estar vazio.');
            return false; 
        }
        if(!$('#mensagem').val().trim()){
            alert('A mensagem não pode estar vazia.');
            return false; 
        }
    };
    
    // Função de Callback do Post do Formulario
    function showResponse(response){        
        alert(response.msg);
    };
    
    $('#btnEnviaEmail').click(function(){
        $('#frmContato').ajaxForm({
            clearForm: true,
            beforeSubmit: validaForm,
            success: showResponse,
            url: '<?php echo base_url('Principal/enviarEmailContato') ?>',
            type:'post',
            dataType : 'json'
        }); 
        $('#frmContato').submit();
    });
    
});
</script>